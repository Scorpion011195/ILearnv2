<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WordUserService; 
use App\Http\Request\WordUserUpdateRequest;
use DB;
use Auth;

class WordUserController extends Controller
{
    //
    private $wordUserService;

    public function __construct(WordUserService $wordUserService){
        $this->wordUserService = $wordUserService;
    }
    public function getAddWordFromSearch()
    {
        $user_id = Auth::user()->id;
        $language = $this->wordUserService->getLanguages();
        $typeWordName = $this->wordUserService->getTypeWord(); 
        $getWordToUser = $this->wordUserService->getWordUser($user_id);
        $getTypeReminder = $this->wordUserService->getTypeReminder();
        $getTimeReminder = $this->wordUserService->getTimeReminder();
        $getSettingUser = $this->wordUserService->getSettingUser($user_id);
        
        return view('user.pages.history')->with([
                'language' => $language,
                'typeWordName' => $typeWordName,
                'getWordToUser' => $getWordToUser,
                'getTypeReminder' => $getTypeReminder,
                'getTimeReminder' => $getTimeReminder,
                'getSettingUser' => $getSettingUser
            ]);
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

        //Check Word existed
        $isWordExist = $this->wordUserService->checkWordUserExist($word, $mean, $typeWord, $langPairName, $userId);
        if($isWordExist)
        {
            $dataResponse = ["data"=>false];
            return json_encode($dataResponse);
        }
        else
        {
            // Insert to word_users
            $arrMyWord = ['user_id'=>$userId, 'word'=> $word, 'mean'=> $mean, 'type_word'=>$typeWord, 'lang_pair_name'=>$langPairName, 'from_language_id'=>$langPairFrom, 'to_language_id' => $langPairTo,'is_notification'=> 0];

            $this->wordUserService->create($arrMyWord);
            $dataResponse = ["data"=>true];
            return json_encode($dataResponse);
        }
    }

    //Function Update Notification

    public function postUpdateNotification(Request $request)
    {
        // Input
        $word = $request->word;
        $mean = $request->mean;
        $id = $request->id;
        $is_notification = $request->is_notification;

        // Update to word_users
        $arrNotification = ['is_notification' => $is_notification];
        $this->wordUserService->update($id, $arrNotification);

        // Check input
        if($is_notification == 1)
        {
            $dataResponse = ["data"=>true];
            return json_encode($dataResponse);
        }
        else {
            $dataResponse = ["data"=>false];
            return json_encode($dataResponse);
        }
    }

    //delete word in my history

    public function postDeleteWordHistory(Request $request)
    {
        // Input
        $word = $request->word;
        $mean = $request->mean;
        $id = $request->id;

        //Delete
        $this->wordUserService->delete($id);

        $dataResponse = ['data' => true];
        return json_encode($dataResponse);
    }

    //Add Word From My History

    public function postAddWordUserFromMyHistory(Request $request)
    {
        // Input
        $fromText = $request->fromText;
        $toText = $request->toText;
        $langPairName = $request->langPairName;
        $langPairId = $request->langPairId;
        $typeWord = $request->typeWord;

        $langPairFrom = $langPairId[0];
        $langPairTo = $langPairId[1];

        $userId = Auth::user()->id;

        // Check word and mean
        if(empty($fromText)){
            $dataResponse = ["data"=>'emptyFrom'];
            return json_encode($dataResponse);
        }
        if(empty($toText)){
            $dataResponse = ["data"=>'emptyTo'];
            return json_encode($dataResponse);
        }

        //Check Max lenght Word
        $lengthFromText = strlen($fromText);
        $lengthToText = strlen($toText);

        if($lengthFromText > 1000 || $lengthToText > 1000)
        {
            $dataResponse = ["data"=>'invalidMaxlenght'];
            return json_encode($dataResponse);
        }

        // Check Lenght letter before Insert To DB
        $checkLengWordFromText = $this->checkLengWord($fromText);
        $checkLengWordToText = $this->checkLengWord($toText);
        
        if(!$checkLengWordFromText || !$checkLengWordToText)
        {
            $dataResponse = ["data"=>'invalid'];
            return json_encode($dataResponse);

        }

        // Check Word existed
        $isWordExist = $this->wordUserService->checkWordUserExist($fromText, $toText, $typeWord, $langPairName, $userId);
        if($isWordExist)
        {
            $dataResponse = ["data"=>false];
            return json_encode($dataResponse);
        }
        else
        {
            // Insert to word_users
            $arrMyWord = ['user_id'=>$userId, 'word'=> $fromText, 'mean'=> $toText, 'type_word'=>$typeWord, 'lang_pair_name'=>$langPairName, 'from_language_id'=>$langPairFrom, 'to_language_id' => $langPairTo,'is_notification'=> 0];

            $this->wordUserService->create($arrMyWord);

            // Get id of new word;
            $id = $this->wordUserService->findIdByColums($fromText, $toText, $typeWord, $langPairName, $userId);

            $dataResponse = ["data"=>true, 'id' => $id];
            return json_encode($dataResponse);
        }
    }

    // Function check lenght word
    public function checkLengWord($input){
        $explodeInput = explode(" ", $input);
        for($i = 0; $i < count($explodeInput); $i++)
        {
            $lenghtInput = strlen($explodeInput[$i]);

            if($lenghtInput > 45)
            {
                return false;
            }
        }
        return true;
    }

    public function getTypeWordFromLanguage($type){
        $html = '';  
        $result = $this->wordUserService->getTypeWordByType(explode('_', $type)[1]);
            foreach ($result as $value) {
                $html .= '<option value="'. $value->name_type_word.'">'. $value->name_type_word.'</option>';
            }
        echo $html;
    }
}
