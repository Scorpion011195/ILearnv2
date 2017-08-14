<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistic;
use App\Services\StatisticService;
use DB;
use DateTime;


class StatisticManagementController extends Controller
{
      private $statistic;

    public function __construct(StatisticService $statistic)
    {
      $this->statistic = $statistic;
    }
    public function displaySceenST(){
        if(isset($dataChecker)){
            return view('admin.pages.dict.collect')->with(['data'=>$dataChecker]);
        }
        return view('admin.pages.dict.collect');
    }
    public function displayByOb(){
        return view('admin.pages.dict.collect');
    }
    // Display result after statistic
    public function displayStatisticalResult(){
        $db = DB::table('word_users')->get();
        $dataChecker = DB::table('statistic_words')->orderBy('quanlity', 'desc')->paginate(10);
        $countChecker = count($dataChecker);
        $countDB = count($db);
        $ldate = new DateTime('now');
        
        foreach ($db as $value) 
        {
            $from  = $value->word;
            $to = $value->mean;
            $result = $this->statistic->findWordInBD($from,$to);
            if($result == true)
            {
                $checkWord = DB::table('word_users')
                    ->where('word',$value->word)
                    ->where('mean',$value->mean)
                    ->get();
                $count = count($checkWord);
                if($count > 0){
                    $quanlity = DB::Table('statistic_words')
                    ->where('from_text',$value->word)
                    ->where('to_text',$value->mean)
                    ->value('quanlity');
                $quanlity = $count;
                $numOfUses = DB::Table('statistic_words')
                    ->where('from_text',$value->word)
                    ->where('to_text',$value->mean)
                    ->update(['quanlity' => $quanlity]);
                }
            }
            else
            {
                $checker = $this->statistic->chekWord($from,$value->to_language_id); 
                if($checker == true){
                    $Aval = "Added";
                }
                else{
                  $checker = $this->statistic->chekWord($from,$value->from_language_id);
                  if($checker == true){
                    $Aval = "Added";
                  }
                  else{
                    $Aval = "Waitting";
                  }
                }
                
                $data = DB::Table('statistic_words')->insert(['from_text' => $value->word,'to_text' => $value->mean,'from_language_id' => $value->from_language_id,'to_language_id' => $value->to_language_id,'type_word' => $value->type_word,'isAvailable' => $Aval,'created_at'=>$ldate ]);
            }
        }
        if(isset($value)){
            /*Check isAvaliable of Word*/
            $checkData = DB::table('dictionarys')->where('word',$value->word)->where('language_id',$value->from_language_id)->get();
            if(count($checkData) > 0){
                $numOfUses = DB::Table('statistic_words')
                        ->where('from_text',$value->word)
                        ->where('to_text',$value->mean)
                        ->update(['isAvailable' => "Added"]);

            }
            else{
                $checkData = DB::table('dictionarys')->where('word',$value->mean)->where('language_id',$value->to_language_id)->get();
                if(count($checkData) > 0){
                    $numOfUses = DB::Table('statistic_words')
                        ->where('from_text',$value->word)
                        ->where('to_text',$value->mean)
                        ->update(['isAvailable' => "Added"]);
                }

            }
        }   
            /*End Check*/
            return view('admin.pages.dict.collect')->with(['data'=>$dataChecker]);

    }

    // Display result by conditio
    public function collectByOb(request $request)
    {
        $value =$request->obCollect;
        $gtData = DB::table('statistic_words')->where('isAvailable',$value)->get();
        return view('admin.pages.dict.collect')->with(['data'=> $gtData]);
    }
    public function getResult(request $request){
        $avl = $request->value;
        $data = DB::table('statistic_words')->where('isAvailable',$avl)->get();
        $count = count($data);
        if($count > 0){
            echo '<div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                                   aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th class="text-center col--width1" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID
                                    </th>
                                    <th class="text-center col--width3" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Từ
                                    </th>
                                    <th class="text-center col--width3" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Browser: activate to sort column ascending">Nghĩa
                                    </th>
                                    <th class="text-center col--width2" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Platform(s): activate to sort column ascending">
                                        Từ điển
                                    </th>
                                    <th class="text-center col--width2" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">
                                        Lượt sử dụng
                                    </th>
                                    <th class="text-center col--width2" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">
                                        Từ loại
                                    </th>
                                    <th class="text-center col--width2" aria-controls="example1" rowspan="1" colspan="1"
                                        aria-label="Engine version: activate to sort column ascending">
                                        Tình trạng
                                    </th>
                                </tr>
                                </thead>
                                <tbody>';
            foreach ($data as $value){
                echo '<tr>';
                echo '<td class="text-center align--vertical-middle">'.$value->id.'</td>';
                echo '<td class="text-center align--vertical-middle">'.$value->from_text.'</td>';
                echo '<td class="text-center align--vertical-middle">'.$value->to_text.'</td>';
                if( $value->from_language_id !== 3 && $value->to_language_id !==1){
                   echo '<td class="text-center align--vertical-middle">'.'Anh-Việt'.'</td>';
                }else{
                   echo '<td class="text-center align--vertical-middle">'.'Việt-Anh'.'</td>';
                }
                echo '<td class="text-center align--vertical-middle">'.$value->quanlity.'</td>';
                echo '<td class="text-center align--vertical-middle">'.$value->type_word.'</td>';
                if($value->isAvailable == "Added")
                {
                echo '<td class="text-center align--vertical-middle">'.'Added'.'</td>';
                }else {
                echo '<td class="text-center align--vertical-middle">'.'<button class="form-control">Waitting</button'.'</td>';
                }    
            }
            echo '</tbody>
                    </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Tổng cộng có '. $count.' kết quả
                            </div>
                        </div>
                        <div class="col-sm-7">
                        </div>
                    </div>
                </div>';
        }
        else{
            echo "<center><h4 style='color:red'>Không có dữ liệu với tình trạng <b>".$request->value." </b></h4></center>";
        }
    }
}
