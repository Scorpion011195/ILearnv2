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
                  'message' => 'Từ và nghĩa không được giống nhau !',
                  'to' =>$toText,
                  'from' =>$fromText,
                  'pronoun' =>$pronoun,
                  'ssFromLang' =>$fromLg,
                  'ssToLang' =>$toLg,
                  'ssType' =>$typeWord,
                ]);
    }
    else{
        $result = $this->dictService->findWordInDB($fromText,$fromLg);
        if($result > 0)
          {
            $result = $this->dictService->findWordInDB($toText,$toLg);
            if($result > 0 )
            {
              return view('admin.pages.dict.create')->with
                (['languages'=> $lang,
                  'typeWord'=> $typeOfWord,
                  'message' => 'Từ  "'.$fromText.'" và nghĩa "'.$toText.'"  đã có trong hệ thống',
                  'to' =>$toText,
                  'from' =>$fromText,
                  'pronoun' =>$pronoun,
                  'ssType' =>$typeWord,
                  'ssFromLang' =>$fromLg,
                  'ssToLang' =>$toLg,
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
              'message' => 'Đã thêm thành công nghĩa  "'.$toText .'"của từ "'.$fromText.'"!',
              'to' =>$toText,
              'from' =>$fromText,
              'pronoun' =>$pronoun,
              'ssFromLang' =>$fromLg,
              'ssToLang' =>$toLg,
              'ssType' =>$typeWord,
              ]);
                  $dataResponse = ["data"=>true];
    return json_encode($dataResponse);
            }
          }
        else
        {
      // Tìm kiếm và kiểm trá nghĩa xem có tồn tại hay không
          $result = $this->dictService->findWordInDB($toText,$fromLg);
          if($result > 0)
            {
              $result = $this->dictService->findWordInDB($fromText,$toLg);
              if($result > 0 )
              {
                return view('admin.pages.dict.create')->with
                  (['languages'=> $lang,
                    'typeWord'=> $typeOfWord,
                    'message' => 'Từ "'.$fromText.'" và nghĩa "'.$toText.'" đã có trong hệ thống',
                    'to' =>$toText,
                    'from' =>$fromText,
                    'pronoun' =>$pronoun,
                    'ssFromLang' =>$fromLg,
                    'ssToLang' =>$toLg,
                    'ssType' =>$typeWord,
                  ]);
                      $dataResponse = ["data"=>true];
    return json_encode($dataResponse);
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
                'pronoun' =>$pronoun,
                'ssFromLang' =>$fromLg,
                'ssToLang' =>$toLg,
                'ssType' =>$typeWord
                ]);
                    $dataResponse = ["data"=>true];
    return json_encode($dataResponse);
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
              'message' => 'Đã thêm thành công từ "'.$fromText.'" và nghĩa "'.$toText.'" !' ,
                'to' =>$toText,
                'from' =>$fromText,
                'pronoun' =>$pronoun,
                'ssFromLang' =>$fromLg,
                'ssToLang' =>$toLg,
                'ssType' =>$typeWord
              ]);
                  $dataResponse = ["data"=>true];
    return json_encode($dataResponse);
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

       $result = DB::table('dictionarys')
           ->where ('word','like', $textSeach.'%')
            ->paginate(10);
        $mappingId =  DB::table('dictionarys')
           ->where ('word','like',$textSeach.'%')
           ->value('mapping_id');

           /*Nghia*/

       $mean = DB::table('dictionarys')
         ->where ('mapping_id','=',$mappingId)
          ->paginate(10); 

        return view('admin.pages.dict.search')->with (['typeWord' => $typeOfWord,'Lg'=> $lang,'results'=>$result,'word' =>$textSeach,'RtypeWord' => $typeWord,'lang' =>$languageFrom,'mean'=>$mean]);
    }
    else{
          return view('admin.pages.dict.search')->with
          ([
            'typeWord' => $typeOfWord,
            'Lg'=> $lang, 'word' =>$textSeach,'RtypeWord' => $typeWord,'lang' =>$languageFrom
          ]);
    }
  }
  public function searchWithType(request $request){
    $textSeach = $request->text;
    if($request->value == ""){
      $result = DB::table('dictionarys')
           ->where ('word','like','%'.$textSeach.'%')
            ->get();
       $mappingId =  DB::table('dictionarys')
           ->where ('word','like',$textSeach.'%')
           ->value('mapping_id');

           /*Nghia*/

       $mean = DB::table('dictionarys')
         ->where ('mapping_id','=',$mappingId)
          ->paginate(10); 

    }else{
        $result = DB::table('dictionarys')
           ->where ('word','like','%'.$textSeach.'%')
           ->where ('type_word','=', $request->value)
            ->get();
         $mappingId =  DB::table('dictionarys')
         ->where ('word','like',$textSeach.'%')
         ->where ('type_word','=', $request->value)
         ->value('mapping_id');

         /*Nghia*/
         
         $mean = DB::table('dictionarys')
         ->where ('mapping_id','=',$mappingId)
         ->paginate(10);

    }

    $count =count($result);
    if($count < 1 && count($mean) < 1){
      echo "<center><h4 style='color:red'>Từ chưa có trong hệ thống</h4></center>";
    }
    else{
      echo '<div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
              <div class="row">
                  <div class="col-sm-12 table-responsive">
                      <table id="example1" class="table table-bordered table-striped dataTable word--break-word" role="grid"
                             aria-describedby="example1_info">
                          <thead>
                          <tr role="row">
                              <th class="text-center col--width05" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Browser: activate to sort column ascending">ID
                              </th>
                               <th class="text-center col--width3" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Browser: activate to sort column ascending">Từ
                              </th>
                              <th class="text-center col--width3" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Browser: activate to sort column ascending">Nghĩa
                              </th>
                               <th class="text-center col--width3" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Browser: activate to sort column ascending">Từ điển
                              </th>
                              <th class="text-center col--width4" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Platform(s): activate to sort column ascending">
                                  Phát âm
                              </th>
                              <!-- If not contributor -->                    
                                <th class="text-center col--width1" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Engine version: activate to sort column ascending">
                                  Hành động
                                </th>
                          </tr>
                          </thead>

                          <tbody>';
      foreach($result as $key =>$value){
        foreach($mean as $key =>$mean){
          $languageFrom = Db::table('languages')->where('id',$value->language_id)->value('name_language');
          $languageTo = Db::table('languages')->where('id',$mean->language_id)->value('name_language'); 
            echo '<tr role="row" class="odd" id="_tr">';
            echo '<td class="_word-id text-center align--vertical-middle" data-id="'.$value->id.'">'. $value->id.'</td>';
            echo '<td class="_word text-center align--vertical-middle" id="_td-word{!! $value->id !!}">'.$value->word.'</td>';
            echo '<td class="_word text-center align--vertical-middle" id="">'.$mean->word.'</td>';
            echo '<td class="_word text-center align--vertical-middle" id="">'.$languageFrom.'  - '. $languageTo.'</td>';
            echo '<td class="_pronoun text-center align--vertical-middle">'.$value->pronounce.'</td>';
            echo '<td class="text-center align--vertical-middle">
            <a class="delete_"><i class="fa fa-trash"></i></a>
            <a  class="_update-word" style="padding-left: 5px"  data-toggle="modal" data-target="#myModal"><i class= "fa fa-pencil"></i></a>
            </td>
            </tr>';
          } 
        }
    }
  }
  public function searchWithLang(request $request){
    $textSeach = $request->text;
    if($request->type == ""){
      $result = DB::table('dictionarys')
           ->where ('word','like',$textSeach.'%')
           ->where('language_id' ,'=' ,$request->lang)
            ->get();
      $mappingId =  DB::table('dictionarys')
     ->where ('word','like',$textSeach.'%')
      ->where('language_id' ,'=' ,$request->lang)
     ->value('mapping_id');

     /*Nghia*/
     
     $mean = DB::table('dictionarys')
     ->where ('mapping_id','=',$mappingId)
     ->paginate(10);
    }else{
      $result = DB::table('dictionarys')
             ->where ('word','like',$textSeach.'%')
             ->where ('type_word','=', $request->type)
             ->where('language_id' ,'=' ,$request->lang)
              ->get();
      $mappingId =  DB::table('dictionarys')
     ->where ('word','like',$textSeach.'%')
     ->where ('type_word','=', $request->value)
     ->where('language_id' ,'=' ,$request->lang)
     ->value('mapping_id');

     /*Nghia*/
     
     $mean = DB::table('dictionarys')
     ->where ('mapping_id','=',$mappingId)
     ->paginate(10);
    }
    $count =count($result);
    if($count < 1 && count($mean) < 1){
      echo "<center><h4 style='color:red'>Từ chưa có trong hệ thống</h4></center>";
    }
    else{
      echo '<div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
              <div class="row">
                  <div class="col-sm-12 table-responsive">
                      <table id="example1" class="table table-bordered table-striped dataTable word--break-word" role="grid"
                             aria-describedby="example1_info">
                          <thead>
                          <tr role="row">
                              <th class="text-center col--width05" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Browser: activate to sort column ascending">ID
                              </th>
                               <th class="text-center col--width3" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Browser: activate to sort column ascending">Từ
                              </th>
                              <th class="text-center col--width3" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Browser: activate to sort column ascending">Nghĩa
                              </th>
                               <th class="text-center col--width3" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Browser: activate to sort column ascending">Từ điển
                              </th>
                              <th class="text-center col--width4" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Platform(s): activate to sort column ascending">
                                  Phát âm
                              </th>
                              <!-- If not contributor -->                    
                                <th class="text-center col--width1" aria-controls="example1" rowspan="1" colspan="1"
                                  aria-label="Engine version: activate to sort column ascending">
                                  Hành động
                                </th>
                          </tr>
                          </thead>

                          <tbody>';
      foreach($result as $key =>$value){
        foreach($mean as $key =>$mean){
          $languageFrom = Db::table('languages')->where('id',$value->language_id)->value('name_language');
          $languageTo = Db::table('languages')->where('id',$mean->language_id)->value('name_language'); 
            echo '<tr role="row" class="odd" id="_tr">';
            echo '<td class="_word-id text-center align--vertical-middle" data-id="'.$value->id.'">'. $value->id.'</td>';
            echo '<td class="_word text-center align--vertical-middle" id="_td-word{!! $value->id !!}">'.$value->word.'</td>';
            echo '<td class="_word text-center align--vertical-middle" id="">'.$mean->word.'</td>';
            echo '<td class="_word text-center align--vertical-middle" id="">'.$languageFrom.'  - '. $languageTo.'</td>';
            echo '<td class="_pronoun text-center align--vertical-middle">'.$value->pronounce.'</td>';
            echo '<td class="text-center align--vertical-middle">
            <a class="delete_"><i class="fa fa-trash"></i></a>
            <a  class="_update-word" style="padding-left: 5px"  data-toggle="modal" data-target="#myModal"><i class= "fa fa-pencil"></i></a>
            </td>
            </tr>';
          } 
        }
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
