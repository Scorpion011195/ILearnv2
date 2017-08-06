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
    public function chekWord($word,$language_id){
        $checker = DB::table('dictionarys')
        ->where('word',$word)
        ->where('language_id',$language_id)
        ->get();
         $count = $checker->count();
        if($count > 0){
            return true;
        }
        else{
            // Word doesn't exist in from-table
            return false;
            
        }
    }
    public function findIdUser($id)
    {
        $id = DB::table('statistic_words')
        ->where('from_text', '=', $from)
        ->where('to_text', '=', $to)
        ->value('user_id');
        $count = $id->count();
        if($count > 0){
            return true;
        }
        else{
            // Word doesn't exist in from-table
            return false;
            
        }
    }

}