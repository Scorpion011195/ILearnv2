<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;
use Input;
use App\Services\UserInformationService;
use App\Models\UserInformation;
use App\Services\UserService;
use App\Models\User;
use App\Models\Language;
use App\Services\languageService;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\MessageBag;
use App\Http\Requests\AdminPersonalInformationRequest;
use App\Http\Requests\AdminResetPasswordRequest;
use App\Http\Controllers\DictionaryManagementController;
use App\Http\Requests\AdminGetProfileRequest;
class AdminController extends Controller
{
	function getLogin()
	{
        if(Session::has('user') || (isset(Auth::user()->id))){
          return redirect('admin');
        }
        else{
            return view('admin.pages.login');
   		}
	}
    function postLogin(AdminLoginRequest $request)
    {
        $username = $request['username'];
        $password = $request['password'];
        $check = ['username'=>$username,'password'=>$password,'status' => MyConstant::STATUS_USER['Hoạt động']];
		if(Auth::attempt($check) && Auth::user()->role_id !=5){
             Session::put('user', Auth::user());
             $errors = new MessageBag(['Đăng nhập thành công']);
        	return view('admin.layouts.ilearn');
        }else{
        	 $errors = new MessageBag(['errorLogin' => '<b>Username</b> hoặc <b>Password</b> không đúng!']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }
    function logout(){
        Auth::logout();
        Session::forget('user');
        return redirect()->route('adminGetLogin');
    }
    function getProfile()
    {
        $id = Auth::user()->id;
        if($id == null){
          return redirect()->route('adminGetLogin');
        }
        else{
            $UserInfomation = DB::table('users')->where('id',$id)->first();
            return view('admin.pages.user.profile.profile',['infomation' =>$UserInfomation]);
        }
    }
    function updateProfile(AdminGetProfileRequest $request)
    {
        $UserId = Auth::user()->id;
        $UserInfomation = User::find($UserId);
        $nameUser = $request->name;
        $phoneUser = $request->phone;
        $addressUser = $request->address;
        $dobUser = $request->dob;
        $inputData = Input::all();
        $password = $inputData['password'];
        $UserInfomation->name =$nameUser;
        $UserInfomation->phone =$phoneUser;
        $UserInfomation->address =$addressUser;
        $UserInfomation->date_of_birth =$dobUser;
        $UserInfomation->password =bcrypt('$password');
        $UserInfomation->update();
        $passwords = $password;
        $message = "Cập nhật thông tin thành công";
        return view('admin.pages.user.profile.profile',['infomation' =>$UserInfomation,'message' => $message,'pass' => $passwords]);
    }
}