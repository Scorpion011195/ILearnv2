<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistic;
use DB;


class StatisticManagementController extends Controller
{
    // Display result after statistic
    function displayStatisticalResult(){
    	$data  = DB::table('word_users')->get();
    		$count = 1;
	    	foreach ($data as $datas){
	    		$word =$datas->word;
	    	}
        return view('admin.pages.dict.collect');
    }

    // Display result by conditio
    function displayStatisticalResultByCondition(Request $request){
        // Input
        return view('admin.pages.dict.collect');
    }
}
