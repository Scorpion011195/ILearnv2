<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WordUserUpdateRequest;
use App\Models\Language;
use App\Controllers\MyConstant;
use DB;

class WordUserController extends Controller
{
    //
    public function update(WordUserController $request)
    {
    	$getTypeWord = MyConstant::TYPE_WORD_VIETNAMESE_VDICT;
    	$lang = DB::table('languages')->get();
    }

    public function store(Request $request)
    {
    	$wordUser = new WordUser;
    	$lang = DB::table('languages')->get();

    	$getTypeWord = MyConstant::TYPE_WORD_VIETNAMESE_VDICT;

    	return view('user.pages.history')->with([
    		'language' => $lang,
    		'getTypeWord' => $getTypeWord;
    		])
    }
}
