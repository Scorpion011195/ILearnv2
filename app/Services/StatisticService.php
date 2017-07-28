<?php
namespace App\Services;

use App\Models\Statistic;
use DB;

class StatisticService extends BaseService  {

	public function __construct(Statistic $model)
    {
        $this->model = $model;
    }
    public function findWordInBD($from, $to)
    {
        $result = DB::table('statistic_words')
        ->where('from_text', '=', $from)
        ->where('to_text', '=', $to)
        ->get();
        $count = $result->count();
        if($count > 0){
            return true;
        }
        else{
            // Word doesn't exist in from-table
            return false;
            
        }
    }
}