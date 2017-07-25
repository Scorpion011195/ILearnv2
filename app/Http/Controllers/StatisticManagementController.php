<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticManagementController extends Controller
{
    // Display result after statistic
    function displayStatisticalResult(){
        return view('admin.pages.dict.collect');
    }

    // Display result by condition
    function displayStatisticalResultByCondition(Request $request){
        // Input
        return view('admin.pages.dict.collect');
    }
}
