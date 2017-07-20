<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserManagementController extends Controller
{
    public function getAccount(){
    	 $listUser = DB::table('users')->get();
    	   $role = DB::table('role_users')->get();
    	 return view('admin.pages.user.user-management.user-management')
    	 ->with(['dataList'=>$listUser,'roleUser'=> $role]);
    }

    public function searchUser(request $request){

    	 $user = $request->nameSearch;
    	 $date = $request->dateSeach;
    	 $role = DB::table('role_users')->get();
    	 $listUser = DB::table('users')->get();

    	 if($user == null && $date == null){
    	 	$message = "Vui lòng nhập từ hoặc chọn ngày để tìm kiếm";
    	 	return view('admin.pages.user.user-management.user-management')->with(['message'=>$message,'dataList'=>$listUser]);
    	 }
    	 if($user !== null && $date == null){
	    	 $result = DB::table('users')->where ('username','like','%'.$user.'%')->get();
     	 }
     	 elseif($user == null && $date !== null){
     	 	$result = DB::table('users')->where ('created_at','=',$date)->get();
     	 }
     	 else{
     	 	$result = DB::table('users')->where ('username','like','%'.$user.'%')
     	 								->where ('created_at','=',$date)->get();
     	 }
    	return view('admin.pages.user.user-management.user-management')->with(['dataSearch'=>$result]);
    }
}
