<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Requests\DictionarySearchRequest;

class DictionaryController extends Controller
{
    //
    public function getSearchDictionary()
    {
    	return view('user.pages.home');
    }

    public function postSearchDictionary()
    {
    	
    }
}
