<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\DictionaryManagement;

class DictionaryManagementController extends Controller 
{
  static function checkWordExist($tableFrom, $column, $wordFrom, $typeWord)
    {
    $data = DB::table('dictionarys')->get();
    $count = $result->count();

    if($count>0){
        foreach ($result as $row){
            $arrWord = json_decode($row->word);
            // Word existed in from-table
            if($typeWord == $arrWord->type){
                return true;
            }
        }
        // Word doesn't exist in from-table
        return false;
    }
    else{
        // Word doesn't exist in from-table
        return false;
    }
  }
  public function getAddWord(request $request){
    $lang = DB::table('languages')->get();
	  $typeOfWord = DB::table('type_words')->get();
    $dict = new DictionaryManagement; 

    $fromLg = $request->fromLg;
    $toLg = $request->toLg;
    $typeWord = $request->typeWord;
    $fromText = $request->fromText;
    $toText  = $request->toText;

    $data = DB::table('dictionarys')->get();

    foreach($data as $value){
      if($fromText == $value->word){
        if($typeWord == $value->type_word_id){
          if($fromLg == $value->id_language){
            if($toText == $value->word && $toLg == $value->id_language){
                echo "Từ đã có trong hệ thống";
              }
            }else{

            }
          }
        }
      }else{
        return view('admin.pages.dict.create')->with
          ([
            'languages'=> $lang , 
            'typeWord'=> $typeOfWord
          ]);
      }
    }
	  return view('admin.pages.dict.create')->with
			([
				'languages'=> $lang , 
				'typeWord'=> $typeOfWord
			]);
  }

  public function return(){
    $lang = DB::table('languages')->get();
     $typeOfWord = DB::table('type_words')->get();
     return view('admin.pages.dict.create')->with
      ([
        'languages'=> $lang , 
        'typeWord'=> $typeOfWord
      ]);
  }
}
