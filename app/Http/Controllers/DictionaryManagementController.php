<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DictionaryManagementController extends Controller
{
  function create(Request $Request)
  {
  	$lang = DB::table('languages')->get();
  	$typeOfWord = DB::table('type_words')->get();
    return view('admin.pages.dict.create')->with(['languages'=> $lang , 'typeWord'=> $typeOfWord]);;
  }

}
