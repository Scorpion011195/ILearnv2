<?php
namespace App\Http\Controllers;

use App\Repositories\DictionaryRepository;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests\DictionarySearchRequest;
use App\ModelViews\DictionaryViewModel;
use App\Models\TypeWord;
use App\Models\Dictionary;
use Input;
use Sessison;

class DictionaryController extends Controller
{
    //
    public function __construct(DictionaryRepository $lang)
    {
    	$this->lang = $lang;
    }

    public function getSearchDictionary()
    {
    	$languages = DB::table('languages')->get();

    	return view('user.pages.home')->with(['languages' => $languages]);
    }

    public function postSearchDictionary(DictionarySearchRequest $request)
    {   
       
    	$inputText = $request->input('search');
        $arrResultSearch = $this->lang->findWord($inputText);
    	$wordInfo = $arrResultSearch[1];
        $oldLangPair = $arrResultSearch[0];
        $languages = DB::table('languages')->get();

        $selfInfo = $this->lang->findWordSeft($inputText);

        $langInfoRelated = $this->lang->findWordRelated($inputText);

        //Get value with word which related with inputText
            $arraySaveRelate = array();

            for($i = 0; $i < count($langInfoRelated); $i++)
            {
                $languageRelateView = new DictionaryViewModel;

                $word = $langInfoRelated[$i]->word;
                $strTemp = null;
                $isGet = true;
                for($j = 0; $j < strlen($word); $j++) 
                {
                    if ($word[$j] == '(') {
                        $isGet = false;
                    }
                    else if ($word[$j] == ')') {
                        $isGet = true;
                        continue;
                    }
                    if ($isGet == true) {
                        $strTemp = $strTemp.$word[$j];
                    }
                    
                }
                $id = $langInfoRelated[$i]->id;

                $languageRelateView->id = $id;
                $languageRelateView->word = $strTemp;  

                array_push($arraySaveRelate, $languageRelateView);
            }

    	if($wordInfo == false)
        {
            return view('user.pages.home')->with([
                'status' => 'Không tìm thấy từ:',
                'languages' => $languages,
                'inputText' => $inputText,
                'workRelate' => $arraySaveRelate,
                'oldLangPair' => $oldLangPair
                ]);
        }
        else 
            {

                //Get value inputText to explain input Text
                $arraySaveSelf = array();

                for($i = 0; $i < count($selfInfo) ; $i++)
                {
                    $langSelfView = new DictionaryViewModel;

                    $id = $selfInfo[$i]->id;
                    $listen = $selfInfo[$i]->listen;
                    $explain = $selfInfo[$i]->explain;
                    $pronounce = $selfInfo[$i]->pronounce;

                    $langSelfView->id = $id;
                    $langSelfView->listen = $listen;
                    $langSelfView->pronounce = $pronounce;

                    array_push($arraySaveSelf, $langSelfView);

                }

                //Get value for 
                $arraySaveView = array();

                for($i = 0; $i < count($wordInfo); $i++)
                {
                    for($j = 0; $j < count($wordInfo[$i]); $j++)
                    {

                        $languageView = new DictionaryViewModel;

                        $word = $wordInfo[$i][$j]->word;

                        $id = $wordInfo[$i][$j]->id;
                        $type_word = $wordInfo[$i][$j]->type_word;

                        // $arrayTypeWOrd = MyConstant::TYPE_WORD_VIETNAMESE_VDICT;
                        // $arrayTypeWOrd = array_flip($arrayTypeWOrd);
                        // $TypeWord = $arrayTypeWOrd[$type_word_id];

                        $languageView->id = $id;
                        $languageView->type_word = $type_word ;
                        $languageView->word = $word;  

                        array_push($arraySaveView, $languageView);
                    }
                }
            }
            return view('user.pages.result')->with([
                'workInfo' => $arraySaveView,
                'workSelf' => $arraySaveSelf,
                'inputText' => $inputText,
                'workRelate' => $arraySaveRelate,
                'languages'=> $languages, 
                'oldLangPair' => $oldLangPair
                ]);

    }
}
