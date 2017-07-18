<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\Dictionary;
use App\Services\DictionaryService;
class DictionaryManagementController extends Controller 
{
  private $dictService;

  public function __construct(DictionaryService $dictService)
    {
        $this->dictService = $dictService;
    }

  public function getAddWord(request $request){
    $lang = DB::table('languages')->get();
	  $typeOfWord = DB::table('type_words')->get();

    $fromLg = $request->fromLg;
    $toLg = $request->toLg;
    $typeWord = $request->typeWord;
    $fromText = $request->fromText;
    $toText  = $request->toText;

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
        'languages'=> $lang, 
        'typeWord'=> $typeOfWord
      ]);
  }
  public function test(){

    // $word = $request->fromLg;
    // $languageId = $request->toLg;
    // $typeWordId = $request->typeWord;
    // $word = $request->fromText;

    $result = $this->dictService->checkWordExist('hello',1,1);
    if($result > 0){
      var_dump($result);
      die();
    }
    else{
      echo "ok";
    }
  }
}
