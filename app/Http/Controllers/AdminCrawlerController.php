<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\AdminUploadWordsRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use App\Services\DictionaryService;
use App\Services\IsUploadDictionaryService;
use DB;
use Log;

class AdminCrawlerController extends Controller
{
    private $dictService;
    public function __construct(DictionaryService $dictService){
        $this->dictService = $dictService;
    }

    /* Crawler from https://vdict.com/
       $langPairId 1:en-vi, 2:vi-en */
    function crawlerVdict($text, $langPairId){
        // Init a CURL
        $ch = curl_init();
        // Config for CURL
        $link = 'https://vdict.com/'.$text.','.$langPairId.',0,0.html';

        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6"); // set browser/user agent
        // Execute CURL
        $result = curl_exec($ch);
        // Get pronounce
        $pattern0 = "/<div class=\"pronounce\">(.*?)<\/div>/si";
        preg_match_all($pattern0, $result, $arrPronounce);
        // Choose area get data
        $pattern1 = '/<div class=\"phanloai\">(.*?)<div class=\"relatedWord\">/si';
        preg_match_all($pattern1, $result, $data);
        // Check isResult
        if(count($data[0])>0){// If isResult=true
            // Get array type word
            $pattern2 = "/<div class=\"phanloai\">(.*?)<\/div>/si";
            preg_match_all($pattern2, $data[0][0], $arrTypeWord);
            // Break segment same type word
            $pattern3 = '/<ul class=\"list1\"><li><b>(.*?)<div/si';
            preg_match_all($pattern3, $data[0][0], $segmentWord);
            // Count type word
            $lengthArr = count($arrTypeWord[1]);
            $arrWordByType = array();
            // Get array word in a array type word
            foreach ($segmentWord[0] as $segment) {
                $pattern4 = '/<b>(.*?)<\/b>/si';
                preg_match_all($pattern4, $segment, $arrWordSameType);
                array_push($arrWordByType, $arrWordSameType[1]);
            }
            // Close CURL, freedom
            curl_close($ch);
            // Return result
            $arrAllResult = array();// [0]: pronounce, [1]: array type words, [2]: array mean words
            if(isset($arrPronounce[1][0])){
                array_push($arrAllResult, $arrPronounce[1][0]);
            }
            else{
                array_push($arrAllResult, "");
            }
            array_push($arrAllResult, $arrTypeWord[1]);
            array_push($arrAllResult, $arrWordByType);
            return $arrAllResult;
        }
        else{
            Log::warning('Warning: Cannot find this word!');
            return -1;
        }
    }

    function postUploadWords(AdminUploadWordsRequest $request){
        // Check is_upload from DB
        $isUpload = $this->dictService->getIsUpload();
        if($isUpload){// 1: is uploading
            $errors = new MessageBag(['alertMax' => 'Quá trình upload đang được thực hiện. Xin bạn vui lòng quay lại sau!']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
        else{// 0: none uploading
            $this->dictService->setIsUpload(1);// Turn on 1: is uploading
        }

        // Input
        $file = $request->file('fileWordsUpload');

        $codeLanguageVdict = $request->codeLanguageVdict;
        if($codeLanguageVdict==MyConstant::CRAWLER_VDICT_LANGPAIR['en-vi']){
            $fromLangId = MyConstant::LANGUAGE['Anh'];
            $toLangId = MyConstant::LANGUAGE['Việt'];
            $isCutWord = false; // File txt utf-8 need cut 3 first-words
        }
        if($codeLanguageVdict==MyConstant::CRAWLER_VDICT_LANGPAIR['vi-en']){
            $fromLangId = MyConstant::LANGUAGE['Việt'];
            $toLangId = MyConstant::LANGUAGE['Anh'];
            $isCutWord = true; // File txt utf-8 need cut 3 first-words
        }
        // Count line of file text
        $content = fopen($file,"r");
        $linecount = 1;
        while(!feof($content)){
          $line = fgets($content);
          $linecount = $linecount + substr_count($line, PHP_EOL);
        }
        fclose($content);
        // If file over maximum
        if($linecount>100){
            $this->dictService->setIsUpload(0);// Turn off 0: end upload
            $errors = new MessageBag(['alertMax' => ' File không được quá 100 dòng!']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
        // If not over maximum
        // Set time execute
        ini_set('max_execution_time', 600); //300 seconds = 5 minutes

        // If line validate
        $content = fopen($file,"r");
        DB::beginTransaction();
        try {
            while(! feof($content)){
                $word = fgets($content);
                $word = trim($word);

                if($isCutWord){
                    $word = substr($word,3);// Unknow 3 first-chars
                    $isCutWord = false;
                }

                Log::info('===== Start word =====');
                Log::info("Word: ".$word);
                // Call crawler word
                $arrAllResult = $this->crawlerVdict($word, $codeLanguageVdict);
                if($arrAllResult==-1){
                    fclose($content);
                    DB::rollback();
                    $this->dictService->setIsUpload(0);// Turn off 0: end upload
                    DB::commit();
                    $errors = new MessageBag(['errorUpload' => 'Từ "'.$word.'" không được tìm thấy!']);
                    return redirect()->back()->withInput()->withErrors($errors);
                }
                else{
                    $strPronounce = $arrAllResult[0];
                    Log::info('Pronounce: '.$strPronounce);
                    $arrTypeWord = $arrAllResult[1];
                    $arrWordByType = $arrAllResult[2];
                    $lengthArr = count($arrTypeWord);
                    for($i=0 ; $i < $lengthArr; $i++) {
                        $typeWord = $arrTypeWord[$i];
                        Log::info('Type: '.$typeWord);
                        // Check word existed?
                        $isWordExisted = $this->dictService->checkWordExist($word, $typeWord, $fromLangId);
                        // If word existed
                        if($isWordExisted){
                            Log::info('---> Word existed!');
                            $mappingId = $this->dictService->getMappingId($word, $typeWord, $fromLangId);
                            if(isset($arrWordByType[$i])){
                                for($j=0 ; $j < count($arrWordByType[$i]); $j++){
                                    $mean = $arrWordByType[$i][$j];
                                    Log::info($mean);
                                    // Check mean existed?
                                    $isMeanExisted = $this->dictService->checkWordExist($mean, $typeWord, $toLangId);
                                    // If mean not existed
                                    if(!$isMeanExisted){
                                        // Add mean to DB
                                        Log::info('---> Mean not exitsed!');
                                        $arrAddMean = ['word'=>$mean, 'type_word'=>$typeWord, 'language_id'=>$toLangId, 'mapping_id'=>$mappingId];
                                        $this->dictService->create($arrAddMean);
                                    }
                                    else{
                                        Log::info('---> Mean exitsed!');
                                    }
                                }
                            }
                        }
                        // If word not existed
                        else{
                            Log::info('---> Word not existed!');
                            $mappingId = $this->dictService->getMaxMappingId();
                            if(isset($arrWordByType[$i])){
                                for($j=0 ; $j < count($arrWordByType[$i]); $j++){
                                    $mean = $arrWordByType[$i][$j];
                                    Log::info($mean);
                                    // Check mean existed?
                                    $isMeanExisted = $this->dictService->checkWordExist($mean, $typeWord, $toLangId);
                                    // If mean existed
                                    if($isMeanExisted){
                                        $mappingId = $this->dictService->getMappingId($mean, $typeWord, $toLangId);
                                        Log::info('---> Mean existed!');
                                        break;
                                    }
                                    // If mean not existed
                                    else{
                                        Log::info('---> Mean not existed!');
                                        // Add mean to DB
                                        $arrAddMean = ['word'=>$mean, 'type_word'=>$typeWord, 'language_id'=>$toLangId, 'mapping_id'=>$mappingId];
                                        $this->dictService->create($arrAddMean);
                                    }
                                }
                            }
                            // Add word to DB
                            $arrAddWord = ['word'=>$word, 'pronounce'=>$strPronounce, 'type_word'=>$typeWord, 'language_id'=>$fromLangId, 'mapping_id'=>$mappingId];
                            $this->dictService->create($arrAddWord);
                        }
                    }
                }
                Log::info('=====  End word  =====');
            }
            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            DB::rollback();
            $this->dictService->setIsUpload(0);// Turn off 0: end upload
            DB::commit();
            $success = false;
        }

        fclose($content);

        if ($success) {
            $this->dictService->setIsUpload(0);// Turn off 0: end upload
            DB::commit();
            $errors = new MessageBag(['errorSuccess' => 'Upload thành công']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
        else{
            $this->dictService->setIsUpload(0);// Turn off 0: end upload
            DB::commit();
            $errors = new MessageBag(['errorUnsuccess' => 'Upload thất bại!']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }
}
