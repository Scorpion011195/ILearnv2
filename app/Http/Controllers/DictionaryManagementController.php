<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\DictionaryManagement;

class DictionaryManagementController extends Controller 
{
   function getAddWord(){
    $lang = DB::table('languages')->get();
	$typeOfWord = DB::table('type_words')->get();

	return view('admin.pages.dict.create')->with
			([
				'languages'=> $lang , 
				'typeWord'=> $typeOfWord
			]);
	  	}
   }
  function adminAdd(Request $request)
  {
    $fromLg = $request->fromLg;
   	$toLg = $request->toLg;
  	$typeWord = $request->typeWord;
  	$fromText = $request->fromText;
  	$toText  = $request->toText;

 //  	$check = ['word'=> $fromText,'type_word_id' => $typeWord,'language_id'=>$fromLg];
 //   	if(isset($check)){
 //   		echo "Đã có từ trong hệ thống";
 //   	}
 //   	else{
	//  	return redirect('/');
	// }

	echo "OK";
}
