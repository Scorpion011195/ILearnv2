<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WordUserService;
use DB;
use Auth;

class WordUserController extends Controller
{
    //
    private $wordUserService;

    public function __construct(WordUserService $wordUserService){
        $this->wordUserService = $wordUserService;
    }

    public function addWordFromSearch(Request $request)
    {   
    	// Input
        $word = $request->word;
        $langPairName = $request->langPairName;
        $langPairId = $request->langPairId;
        $typeWord = $request->typeWord;
        $mean = $request->mean;

        $langPairFrom = $langPairId[0];
        $langPairTo = $langPairId[1];

        $userId = Auth::user()->id;

        // Insert to DB
        $arrMyWord = ['user_id'=>$userId, 'word'=> $word, 'mean'=> $mean, 'type_word'=>$typeWord, 'lang_pair_name'=>$langPairName, 'from_language_id'=>$langPairFrom, 'to_language_id' => $langPairTo,'is_notification'=> 0];
        
        $this->wordUserService->create($arrMyWord);

        $dataResponse = ["data"=>true];
        return json_encode($dataResponse);

        //Check Word existed

        foreach ($arr as $key) {
            if($word == $key['word'] && $mean = $key['mean'])
            {
                $dataResponse = ["data" => "existed"];
                return json_encode($dataResponse);
            }
        }
    }
}
