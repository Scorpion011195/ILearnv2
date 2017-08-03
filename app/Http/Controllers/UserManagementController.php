<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Auth;

class UserManagementController extends Controller
{
    function detailUser(request $request){
        $id =$request->id;
        $data = DB::table('users')->where('id',$id)->get();

        return view('admin.pages.user.user-management.detail-user')->with(['data'=>$data]);
    }
    public function getAccount(){
    	   $listUser = User::paginate(10);
    	   $role = DB::table('role_users')->get();
           $count = (count($listUser));
    	 return view('admin.pages.user.user-management.user-management')
    	 ->with(['dataList'=>$listUser,'roleUser'=> $role,'count'=>$count]);
    }

    public function searchUser(request $request){

    	 $user = $request->nameSearch;
         $date = $request->dateSearch;
    	 $role = DB::table('role_users')->get();
    	 $listUser = DB::table('users')->get();

    	 if($user == null && $date == null){
    	 	$message = "Vui lòng nhập từ hoặc chọn ngày để tìm kiếm";
            $count = 0;
    	 	return view('admin.pages.user.user-management.user-management')->with(['message'=>$message,'dataList'=>$listUser,'roleUser'=> $role,'count'=>$count]);
    	 }
         else{
        	 if($user !== null && $date == null){
    	    	 $result = DB::table('users')->where ('username','like','%'.$user.'%')->paginate(10);
         	 }
         	 elseif($user == null && $date !== null){
         	 	$result = DB::table('users')->where ('created_at','like',$date.'%')->paginate(10);
         	 }
         	 else{
         	 	$result = DB::table('users')->where ('username','like','%'.$user.'%')
         	 								->where ('created_at','like',$date.'%')->paginate(10);
         	 }
             $count = (count($result));
        	return view('admin.pages.user.user-management.user-management')->with(['dataSearch'=>$result,'roleUser'=> $role,'count'=>$count, 'user'=>$user,'date'=>$date]);
        }
    }
    public function changeRole(request $request){
        $id_role = $request->idRole;
        $username = $request->username;
        $idUser =$request->idUser;
        if(Auth::user()->id == $idUser){
             $dataResponse = ["data"=>false];
        return json_encode($dataResponse);
        }
        $data = User::find($idUser);
        $data->role_id = $id_role;
        $data->save();

        $dataResponse = ["data"=>true];
        return json_encode($dataResponse);
    }
    public function changeStatus(request $request){
        $idUser =$request->idUser;
        $status = $request->status;
        if($status == "Block")
        {
            $statusData = 0;
        }
        else{
             $statusData = 1;
        }
        $data = User::find($idUser);
        if($idUser == Auth::id()){
            $dataResponse = ["data"=>false];
            return json_encode($dataResponse);
        }
        $data->status = $statusData;
        $data->save();
        $dataResponse = ["data"=>true];
        return json_encode($dataResponse);
    }
    public function deleteUser(request $request){

        $idUser =$request->idUser;
        $delete = User::find($idUser);
        if($idUser == Auth::id()){

        $dataResponse = ["data"=>false];
        return json_encode($dataResponse);

        }
        $delete->delete();
        $dataResponse = ["data"=>true];
        return json_encode($dataResponse);
    }
    public function  collect(request $request){

        $data = DB::table('users')->orderBy('number_of_use', 'desc')->paginate(10);
        return view('admin.pages.user.user-management.user-collect')->with(['data' =>$data]);
    }
}
