<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;

class UserManagementController extends Controller
{
    public function getAccount(){
    	 $listUser = DB::table('users')->get();
    	   $role = DB::table('role_users')->get();
           $count = (count($listUser));
    	 return view('admin.pages.user.user-management.user-management')
    	 ->with(['dataList'=>$listUser,'roleUser'=> $role,'count'=>$count]);
    }

    public function searchUser(request $request){

    	 $user = $request->nameSearch;
         $date = date('Y-m-d', strtotime($request->dateSeach));
         $formatdate = '1970-01-01';
    	 $role = DB::table('role_users')->get();
    	 $listUser = DB::table('users')->get();

    	 if($user == null && $date == null){
    	 	$message = "Vui lòng nhập từ hoặc chọn ngày để tìm kiếm";
    	 	return view('admin.pages.user.user-management.user-management')->with(['message'=>$message,'dataList'=>$listUser,'roleUser'=> $role]);
    	 }
         else{
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
             $count = (count($result));
        	return view('admin.pages.user.user-management.user-management')->with(['dataSearch'=>$result,'roleUser'=> $role,'count'=>$count]);
        }
    }
    public function changeRole(request $request){
        $id_role = $request->idRole;
        $username = $request->username;
        $idUser =$request->idUser;
        $data = User::find($idUser);
        $data->role_id = $id_role;
        $data->save();

        $dataResponse = ["data"=>true];
        return json_encode($dataResponse);
    }
    public function changeStatus(request $request){
        $idUser =$request->idUser;
        $status = $request->status;
        if($status == "Hoạt động")
        {
            $status = 1;
        }
        else{
             $status = 0;
        }
        $data = User::find($idUser);
        $data->status = $status;
        $data->save();
        $dataResponse = ["data"=>true];
        return json_encode($dataResponse);
    }
    public function deleteUser(request $request){

        $idUser =$request->idUser;
        $delete = User::find($idUser);
        $delete->delete();
        $dataResponse = ["data"=>true];
        return json_encode($dataResponse);
    }


}
