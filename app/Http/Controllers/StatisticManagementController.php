<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statistic;
use DB;


class StatisticManagementController extends Controller
{
    // Display result after statistic
    function displayStatisticalResult(){
    	$word = Db::table('word_users')->get();
        

        return view('admin.pages.dict.collect');
    }

    // Display result by conditio
    function displayStatisticalResultByCondition(Request $request){
        // Input
        return view('admin.pages.dict.collect');
    }
}
