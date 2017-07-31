<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistic;
use App\Services\StatisticService;
use DB;


class StatisticManagementController extends Controller
{
      private $statistic;

    public function __construct(StatisticService $statistic)
    {
      $this->statistic = $statistic;
    }
    // Display result after statistic
    public function displayStatisticalResult(){
        $db = DB::table('word_users')->get();
        $dataChecker = DB::table('statistic_words')->get();
        $countChecker = count($dataChecker);
        $countDB = count($db);
        if($countDB == $countChecker)
        {
            return view('admin.pages.dict.collect');
        }
        foreach ($db as $value) 
        {
            $from  = $value->word;
            $to = $value->mean;
            $result = $this->statistic->findWordInBD($from,$to);
            if($result > 0)
            {
               $quanlity = DB::Table('statistic_words')
                ->where('from_text',$value->word)
                ->where('to_text',$value->mean)
                ->where('from_language_id', $value->from_language_id)
                ->where('to_language_id',$value->to_language_id)
                ->value('quanlity');
                $quanlity = $quanlity + 1;
                $numOfUses = DB::Table('statistic_words')
                ->where('from_text',$value->word)
                ->where('to_text',$value->mean)
                ->where('from_language_id', $value->from_language_id)
                ->where('to_language_id',$value->to_language_id)
                ->update(['quanlity' => $quanlity ]);
            }
            else
            {
                $Available = DB::Table('dictionarys')
                ->where('word',$value->word)
                ->where('language_id',$value->to_language_id)
                ->get();
                $count = count($Available);
                if($count > 0 )
                {
                    $Aval = "YES";
                }
                else
                {
                    $Aval ="NO";
                }
                $data = DB::Table('statistic_words')->insert(['from_text' => $value->word,'to_text' => $value->mean,'from_language_id' => $value->from_language_id,'to_language_id' => $value->to_language_id,'type_word' => $value->type_word,'isAvailable' => $Aval]);
            }
        }
        return view('admin.pages.dict.collect')->with(['data'=>$dataChecker]);

    }

    // Display result by conditio
    public function collectByOb(request $request)
    {
        $value =$request->obCollect;
        $gtData = DB::table('statistic_words')->where('isAvailable',$value)->get();
        return view('admin.pages.dict.collect')->with(['data'=> $gtData]);
    }
}
