<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Dictionary;
use App\Services\DictionaryService;
use App\Http\Requests\AdminAddWordRequest;

use App\Http\Requests\AdminSearchWordRequest;
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
    /*Tìm kiếm và kiểm tra từ có trong hệ thống chưa*/
    if($fromText == $toText ){
        return view('admin.pages.dict.create')->with
                (['languages'=> $lang,
                  'typeWord'=> $typeOfWord,
                  'message' => 'Từ và nghĩa không được giống nhau !'
                ]);
    }
    else{
        $result = $this->dictService->checkWordExist($fromText,$fromLg,$typeWord);
        if($result > 0)
          {
            $result = $this->dictService->checkWordExist($toText,$toLg,$typeWord);
            if($result > 0 )
            {
              return view('admin.pages.dict.create')->with
                (['languages'=> $lang,
                  'typeWord'=> $typeOfWord,
                  'message' => 'Từ '.$fromText.'  đã có trong hệ thống'
                ]);
            }else
            {
              $mapping = DB::table('dictionarys')->where('word', $fromText)
                                                ->where('language_id',$fromLg)
                                                ->value('mapping_id');
              $mappingId = $mapping;
              $dict->word = $toText;
              $dict->type_word = $typeWord;
              $dict->language_id = $toLg;
              $dict->mapping_id = $mappingId;
              $dict->pronounce = $pronoun;
              $dict->save();
              return view('admin.pages.dict.create')->with
              ([
              'languages'=> $lang,
              'typeWord'=> $typeOfWord,
              'message' => 'Đã thêm thành công nghĩa  '.$toText .'!',
              'to' =>$toText,
              'from' =>$fromText,
              'pronoun' =>$pronoun
              ]);
            }
          }
        else
        {
      // Tìm kiếm và kiểm trá nghĩa xem có tồn tại hay không
          $result = $this->dictService->checkWordExist($toText,$toLg,$typeWord);
          if($result > 0)
            {
              $result = $this->dictService->checkWordExist($fromText,$fromLg,$typeWord);
              if($result > 0 )
              {
                return view('admin.pages.dict.create')->with
                  (['languages'=> $lang,
                    'typeWord'=> $typeOfWord,
                    'message' => 'Từ '.$fromText.' đã có trong hệ thống',
                    'to' =>$toText,
                    'from' =>$fromText,
                    'pronoun' =>$pronoun
                  ]);
              }else
              {
                $mapping = DB::table('dictionarys')->where('word', $toText)
                                                  ->where('language_id',$toLg)
                                                  ->value('mapping_id');
                $mappingId = $mapping;
                $dict->word = $fromText;
                $dict->type_word = $typeWord;
                $dict->language_id = $fromLg;
                $dict->mapping_id = $mappingId;
                $dict->pronounce = $pronoun;
                $dict->save();
                return view('admin.pages.dict.create')->with
                ([
                'languages'=> $lang,
                'typeWord'=> $typeOfWord,
                'message' => 'Đã thêm từ '.$fromText.' thành công',
                'to' =>$toText,
                'from' =>$fromText,
                'pronoun' =>$pronoun
                ]);
              }
            }
          else
          {
            $mapping = DB::table('dictionarys')->max('mapping_id');
            $mappingId = $mapping + 1;
            $data = array(
            array('mapping_id'=>$mappingId, 'word'=> $fromText, 'language_id' => $fromLg,'type_word' => $typeWord,'pronounce' => $pronoun),
            array('mapping_id'=>$mappingId, 'word'=> $toText, 'language_id' => $toLg,'type_word' => $typeWord,'pronounce' => $pronoun),
            );
            /* $data add dữ liệu vào DB khi có nhiều hơn 1 value ở single collum*/
            DB::table('dictionarys')->insert($data);
            return view('admin.pages.dict.create')->with
              ([
              'languages'=> $lang,
              'typeWord'=> $typeOfWord,
              'message' => 'Đã thêm thành công từ '.$fromText.' và nghĩa '.$toText.' thành công',
                'to' =>$toText,
                'from' =>$fromText,
                'pronoun' =>$pronoun
              ]);
          }
          /*Peformance Test with 1000 record*/
          // for($i = 0; $i <1000; $i ++){
          //    $data = array('mapping_id'=>$mappingId, 'word'=> md5($fromText), 'language_id' => $fromLg,'type_word' => md5($typeWord),'pronounce' => md5($pronoun));
          //     DB::table('dictionarys')->insert($data);
          //   }
        }
      }
  }

  public function getSearch(){
    $lang = DB::table('languages')->get();
    $typeOfWord = DB::table('type_words')->get();
    return view('admin.pages.dict.search')->with
                                      ([
                                        'typeWord' => $typeOfWord,
                                        'Lg'=> $lang
                                      ]);
  }

  public function search(AdminSearchWordRequest $request)
  {
    $lang = DB::table('languages')->get();
    $typeOfWord = DB::table('type_words')->get();

    $textSeach = $request->searchText;
    $typeWord = $request->typeWord;
    $languageFrom = $request->languageFrom;

    if(isset($textSeach)){

      if(isset($typeWord)){

        if(isset($languageFrom)){
           $result = DB::table('dictionarys')
           ->where ('word','like','%'.$textSeach.'%')
           ->where ('type_word','like','%'.$typeWord.'%')
           ->where ('language_id','=', $languageFrom)
           ->paginate(10);
           return view('admin.pages.dict.search')->with (['typeWord' => $typeOfWord,'Lg'=> $lang,'results'=>$result]);
        }
        else{
          $result = DB::table('dictionarys')
           ->where ('word','like','%'.$textSeach.'%')
           ->where ('type_word','=', $typeWord)
           ->paginate(10);
           return view('admin.pages.dict.search')->with (['typeWord' => $typeOfWord,'Lg'=> $lang,'results'=>$result]);
        }

      }
      else{
        $result = DB::table('dictionarys')
           ->where ('word','like','%'.$textSeach.'%')
            ->paginate(10);
      }

    }
    else{
          return view('admin.pages.dict.search')->with
          ([
            'typeWord' => $typeOfWord,
            'Lg'=> $lang
          ]);
    }
  }

  function deleteWord(Request $request)
  {    
    // Input
    $idWord = $request->idWord;
    $delete = Dictionary::find($idWord);
    $delete->delete();

    $dataResponse = ["data"=>true];
    return json_encode($dataResponse);
  }

  public function updateWord(Request $request)
  {
    $idWord = $request->idWord;
    $updateWord = $request->updateWord;
    $updatePronoun = $request->updatePronoun;

    $update = Dictionary::find($idWord);
    $update->word = $updateWord;
    $update->pronounce = $updatePronoun;
    $update->save();

    $dataResponse = ["data"=>true];
    return json_encode($dataResponse);
  }

  public function collection(request $request){
    return view('welcome');
  }
  public function upload()
  {
    $params = ['codeLanguageVdict' => MyConstant::CRAWLER_VDICT_NAME];
    return view('admin.pages.dict.upload', $params);
  }
}
