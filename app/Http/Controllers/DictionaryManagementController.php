<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\Dictionary;
use App\Services\DictionaryService;
use App\Http\Requests\AdminAddWordRequest;
class DictionaryManagementController extends Controller
{
  private $dictService;

  public function __construct(DictionaryService $dictService)
  {
      $this->dictService = $dictService;
  }

  public function home()
  {
    $lang = DB::table('languages')->get();
    $typeOfWord = DB::table('type_words')->get();
     return view('admin.pages.dict.create')->with
      ([
        'languages'=> $lang,
        'typeWord'=> $typeOfWord
      ]);
  }

  public function getAddWord(AdminAddWordRequest $request)
  {
    $lang = DB::table('languages')->get();
	  $typeOfWord = DB::table('type_words')->get();
    $dict = new Dictionary;

    $fromLg = $request->fromLg;
    $toLg = $request->toLg;
    $typeWord = $request->typeWord;
    $fromText = $request->fromText;
    $toText  = $request->toText;
    $pronoun = $request->pronoun;
    $result = $this->dictService->checkWordExist($fromText,$fromLg,$typeWord);
    if($result > 0)
      {
        $result = $this->dictService->checkWordExist($toText,$toLg,$typeWord);
        if($result > 0 )
        {
          return view('admin.pages.dict.create')->with
            (['languages'=> $lang,
              'typeWord'=> $typeOfWord,
              'message' => 'Từ đã có trong hệ thống'
            ]);
        }else
        {
          $mapping = DB::table('dictionarys')->where('word', $fromText)->value('mapping_id');
          $mappingId = $mapping;
          $dict->word = $toText;
          $dict->type_word_id = $typeWord;
          $dict->language_id = $toLg;
          $dict->mapping_id = $mappingId;
          $dict->pronounce = $pronoun;
          $dict->save();
          return view('admin.pages.dict.create')->with
          ([
          'languages'=> $lang,
          'typeWord'=> $typeOfWord,
          'message' => 'Đã thêm thành công'
          ]);
        }
      }
    else
    {
      $mapping = DB::table('dictionarys')->max('mapping_id');
      $mappingId = $mapping + 1;
      $data = array(
      array('mapping_id'=>$mappingId, 'word'=> $fromText, 'language_id' => $fromLg,'type_word_id' => $typeWord,'pronounce' => $pronoun),
      array('mapping_id'=>$mappingId, 'word'=> $toText, 'language_id' => $toLg,'type_word_id' => $typeWord,'pronounce' => $pronoun),
      );
      /* $data add dữ liệu vào DB khi có nhiều hơn 1 value ở single collum*/
      DB::table('dictionarys')->insert($data);
      return view('admin.pages.dict.create')->with
        ([
        'languages'=> $lang,
        'typeWord'=> $typeOfWord,
        'message' => 'Đã thêm thành công'
        ]);
    }
  }

  public function search()
  {
    $lang = DB::table('languages')->get();
    $typeOfWord = DB::table('type_words')->get();
    return view('admin.pages.dict.search')->with
    ([
      'typeWord' => $typeOfWord,
      'Lg'=> $lang,
    ]);
  }

  public function upload()
  {
    $params = ['codeLanguageVdict' => MyConstant::CRAWLER_VDICT_NAME];
    return view('admin.pages.dict.upload', $params);
  }
}
