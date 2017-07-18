<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Auth;
use Mail;
use Illuminate\Support\Facades\Input;
use DB;
use Session;
use Flash;
use App\Models\User;
use App\Models\SettingUsers;
use Validator;
use Illuminate\Support\MessageBag;

class UserController extends Controller
{
    // Get user login
    public function getLogin()
    {
    	return view('user.pages.login');
    }

    //Post user login
    public function postLogin(Request $request)
    {
    	$rules = 
    		 array(
    			'name'=> 'required|min:6|max:32|alpha_dash',
  				'pass'=> 'required|min:6',
				);
    	$messages = 
    		array(
    			'name.required' => 'Trường username là bắt buộc',
    			'name.required' => 'Trường username là bắt buộc',
    			'name.min' => 'Tên đăng nhập lớn hơn 6 kí tự',
    			'name.max' =>'Tên đăng nhập nhỏ hơn 6 kí tự',
			    'name.alpha_dash' => 'Chỉ nhập các kí tự là: chữ, số, "-", "_"',
			    'pass.required' => 'Mật khẩu là bắt buộc',
			    'pass.min' => 'Mật khẩu lớn hơn 6 kí tự',
			    'pass.max' => 'Mật khẩu nhỏ hơn 32 kí tự',
    		);
    	$validator = Validator::make($request->all(), $rules, $messages);
    	$validator = Validator::make($request->all(), $rules, $messages);

    	if($validator->fails())
    		{
    			return redirect()->back()->withErrors($validator)->withInput();
    		}
    	else {
    		$username = $request->input('name');
    		$password = $request->input('pass');
    		$remember = $request->input('remember');

    		if(Auth()->attempt(['username' =>$username, 'password' =>$password ,'status' => 1, 'confirmed' =>1], $remember))
    		{
    			return redirect()->intended('home');
    		}
    		else {
    			$errors = new Messagebag(['errorLogin' => 'Email hoặc mật khẩu không đúng']);
    			return redirect()->back()->withInput()->withErrors($errors);
    		}
    	}
    }
     //User logout
    public function logout()
    {
    	Auth::logout();
    	Session::forget('user');
    	return redirect()->intended('home');
    }

    //User get Gegister

    public function getRegister()
    {
    	return view('user.pages.register');
    } 

    public function postRegister(RegisterRequest $request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = \Hash::make($request->password);
        $user->status = MyConstant::STATUS_USER['Hoạt động'];
        $user->role_id = MyConstant::ROLE_USER['user'];
        $user->confirmation_code = str_random(30);
        $user->save();

        $setUser= new SettingUsers();
        $setUser->id = $user->id;
        $setUser->user_id = $setUser->id;
        $setUser->type_reminder_id = 1;
        $setUser->time_reminder_id = 1;
        $setUser->isOn = 'OFF';
        $setUser->save();

        $data = $user->toArray();
        Mail::send('user.pages.verifyEmail', $data, function($message) use($data){
            $message->to(Input::get('email'), Input::get('username'))
                ->subject('Verify your email address');
        });

        return redirect()->intended('home')->with('status', 'Cảm ơn bạn đã đăng kí tài khoản tại Ilearn. Vui lòng vào Email của bạn để xác nhận đăng kí ');
    }

    public function confirm($confirmation_code)
    {
        $user = User::whereConfirmationCode($confirmation_code)->first();
        if ( ! $user)
        {
            return redirect('home')->with('status', 'Bạn chưa xác nhận, vui long thử lại');
        }
        $user->confirmed = 1;
        $user->confirmation_code = $confirmation_code;
        $user->save();
        return redirect('home')->with('status', 'Chúc mừng bạn đã đăng kí thành công');
    }
}
