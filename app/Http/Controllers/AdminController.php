<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;
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


class AdminController extends Controller
{
	function getLogin()
	{
        if(Session::has('user')){
           echo "User has loginer";
        }
        else{
            return view('admin.pages.login');
   		}
	}
    function postLogin(Request $request)
    {
        $username = $request['username'];
        $password = $request['password'];
        $check = ['username'=>$username,'password'=>$password,'status' => MyConstant::STATUS_USER['Hoạt động']];

		if(Auth::attempt($check) &&Auth::user()->id_role!=MyConstant::ROLE_USER['user']){
             $errors = new MessageBag(['Đăng nhập thành công']);
        	return redirect('/admin')->withErrors($errors);;
        }else{

        	 $errors = new MessageBag(['errorLogin' => '<b>Username</b> hoặc <b>Password</b> không đúng!']);
            return redirect()->back()->withInput()->withErrors($errors);
        }

    }
}
