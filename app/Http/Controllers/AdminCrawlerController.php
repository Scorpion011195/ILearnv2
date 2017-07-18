<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminUploadWordsRequest;
use Log;
use Illuminate\Support\MessageBag;
use App\Models\Dictionary;
use DB;

class AdminCrawlerController extends Controller
{
    /* Crawler from https://vdict.com/
       $langPairId 1:en-vi, 2:vi-en */
    function crawlerVdict($text, $langPairId){
        Log::info('Starting Crawler...');
        Log::info("Word: ".$text);
        // Init a CURL
        $ch = curl_init();

        // Config for CURL
        curl_setopt($ch, CURLOPT_URL, 'https://vdict.com/'.rawurlencode($text).','.$langPairId.',0,0.html');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6"); // set browser/user agent

        // Execute CURL
        $result = curl_exec($ch);

        // Get pronounce
        $pattern0 = "/<div class=\"pronounce\">(.*?)<\/div>/si";
        preg_match_all($pattern0, $result, $arrPronounce);
        //dd($arrPronounce); die;

        // Choose area get data
        $pattern1 = '/<div class=\"phanloai\">(.*?)<div class=\"relatedWord\">/si';
        preg_match_all($pattern1, $result, $data);
        //dd($data); die;

        // Check isResult
        if(count($data[0])>0){// If isResult=true
            // Get array type word
            $pattern2 = "/<div class=\"phanloai\">(.*?)<\/div>/si";
            preg_match_all($pattern2, $data[0][0], $arrTypeWord, PREG_OFFSET_CAPTURE);
            //dd($arrTypeWord); die;

            // Break segment same type word
            $pattern3 = '/<ul class=\"list1\"><li><b>(.*?)<div/si';
            preg_match_all($pattern3, $data[0][0], $segmentWord);
            //dd($segmentWord); die;

            // Count type word
            $lengthArr = count($arrTypeWord[1]);
            //echo $lengthArr; die;

            $arrWordByType = array();
            // Get array word in a array type word
            foreach ($segmentWord[0] as $segment) {
                $pattern4 = '/<b>(.*?)<\/b>/si';
                preg_match_all($pattern4, $segment, $arrWordSameType);
                array_push($arrWordByType, $arrWordSameType[1]);
            }
            //dd($arrWordByType); die;

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
            array_push($arrAllResult, $arrTypeWord);
            array_push($arrAllResult, $arrWordByType);
            return $arrAllResult;

            // Echo result
            // for($i=0 ; $i < $lengthArr; $i++) {
            //     $typeWord = $arrTypeWord[1][$i][0];

            //     if(isset(MyConstant::TYPE_WORD_VIETNAMESE_VDICT[$typeWord])){
            //         $strTypeWord = MyConstant::TYPE_WORD_VIETNAMESE_VDICT[$typeWord];
            //     }
            //     else{
            //         $strTypeWord = MyConstant::TYPE_WORD_VIETNAMESE_VDICT['chưa xác định'];
            //     }

            //     //echo $strTypeWord.":";
            //     Log::info('Type: '.$typeWord);
            //     if(isset($arrWordByType[$i])){
            //         for($j=0 ; $j < count($arrWordByType[$i]); $j++){
            //             Log::info($arrWordByType[$i][$j]);
            //         }
            //     }
            // }
        }
        else{
            Log::warning('Warning: Cannot find this word!');
            return -1;
        }
    }

    function postUploadWords(AdminUploadWordsRequest $request){
        // Input
        $file = $request->file('fileWordsUpload');
        $codeLanguageVdict = $request->codeLanguageVdict;
        if($codeLanguageVdict==MyConstant::CRAWLER_VDICT_LANGPAIR['en-vi']){
            $fromLang = MyConstant::LANGUAGE['Anh'];
            $toLang = MyConstant::LANGUAGE['Việt'];
        }
        if($codeLanguageVdict==MyConstant::CRAWLER_VDICT_LANGPAIR['vi-en']){
            $fromLang = MyConstant::LANGUAGE['Việt'];
            $toLang = MyConstant::LANGUAGE['Anh'];
        }

        // Count line of file text
        $content = fopen($file,"r");
        $linecount = 1;
        while(!feof($content)){
          $line = fgets($content, 4096);
          $linecount = $linecount + substr_count($line, PHP_EOL);
        }

        if($linecount>100){
            //echo "File khong duoc qua 100 dong"; die;
        }
        fclose($content);

        //echo "File nho hon 100 dong"; die;
        // Set time execute
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes

        // If line validate
        $content = fopen($file,"r");

        DB::beginTransaction();
        try {
            while(! feof($content)){
                $word = fgets($content);

                // Call crawler word
                $arrAllResult = $this->crawlerVdict($word, $codeLanguageVdict);
                if($arrAllResult==-1){
                    DB::rollback();
                    fclose($content);
                    $errors = new MessageBag(['errorUpload' => 'Từ "'.$word.'" không được tìm thấy!']);
                    return redirect()->back()->withInput()->withErrors($errors);
                }
                else{
                    $arrPronounce = $arrAllResult[0];
                    $arrTypeWord = $arrAllResult[1];
                    $arrWordByType = $arrAllResult[2];

                    $lengthArr = count($arrTypeWord[1]);

                    for($i=0 ; $i < $lengthArr; $i++) {
                        $typeWord = $arrTypeWord[1][$i][0];

                        if(isset(MyConstant::TYPE_WORD_VIETNAMESE_VDICT[$typeWord])){
                            $strTypeWord = MyConstant::TYPE_WORD_VIETNAMESE_VDICT[$typeWord];
                        }
                        else{
                            $strTypeWord = MyConstant::TYPE_WORD_VIETNAMESE_VDICT['chưa xác định'];
                        }

                        Log::info('Type: '.$typeWord);
                        if(isset($arrWordByType[$i])){
                            for($j=0 ; $j < count($arrWordByType[$i]); $j++){
                                Log::info($arrWordByType[$i][$j]);

                                // Check word exist
                                echo "word:".$word."<br>";
                                echo "pronounce:".$arrPronounce."<br>";
                                echo "type_word_id:".MyConstant::TYPE_WORD_VIETNAMESE_VDICT[$typeWord]."<br>";
                                echo "language_id:".$fromLang."<br>"; die;
                            }
                        }
                    }



                    // If exist, check mean exist
                       // If mean exist -> do nothing
                       // If mean not exist -> get mapping_id of word -> insert mean

                    // If not exist, check mean exist
                       // If mean exist -> get mapping_id of mean -> insert word
                       // If mean not exist -> get max mapping_id -> insert word and mean
                }
                // Insert words to DB - Log while insert - Transaction
            }
            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }

        fclose($content);

        if ($success) {
            return view('testUploadWord')->with('info', true);
        }
        else{
            return view('testUploadWord')->with('info', false);
        }
    }

    // Check word exist
    function checkWordExist($word, $typeWord){

    }
}
