<?php
namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserProfileRequest;
use App\Http\Requests\ChangePassRequest;
use Auth;
use Mail;
use Illuminate\Support\Facades\Input;
use DB;
use Session;
use Flash;
use Image;
use App\Models\User;
use App\Models\SettingUser;
use Validator;
use Illuminate\Support\MessageBag;
use App\ModelViews\UserViewModel;


class UserController extends Controller 
{
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

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
  				'pass'=> 'required|min:6|max:100',
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
			    'pass.max' => 'Mật khẩu nhỏ hơn 100 kí tự',
    		);
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
                Session::put('isStartNotification', true);
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
        Session::forget('isStartNotification');
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

        $setUser= new SettingUser();
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

        return redirect('home')->with('status', 'Cảm ơn bạn đã đăng kí tài khoản tại Ilearn. Vui lòng vào Email của bạn để xác nhận đăng kí ');
    }

    public function confirm($confirmation_code)
    {
        $user = User::whereConfirmationCode($confirmation_code)->first();
        if ( ! $user)
        {
            return redirect('home')->with('status','Bạn chưa xác nhận, vui lòng thử lại');
        }
        $user->confirmed = 1;
        $user->confirmation_code = $confirmation_code;
        $user->save();
        return redirect('home')->with('status','Chúc mừng bạn đã đăng kí thành công');
    }

    //Get edit user

    public function getEditUser($id)
    {
        $user = User::find($id);
        return view("user.pages.edit_profile")->with('user', $user);
    }
    // Post edit user

    public function postEditUser(UserProfileRequest $request, $id)
    {
        $user = User::find($id);

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = time() . '.' .$image->getClientOriginalExtension();

            Image::make($image)->resize(960,640)->save(public_path('/uploads/images/' . $filename));

            $user->name = $request->name;
            $user->name = $this->user->htmlEntities($user->name);
            $user->phone = $request->phone;
            $user->image = $filename;
            $user->address = $request->address;
            $user->address = $this->user->htmlEntities($user->address);
            $user->date_of_birth = date('Y-m-d',strtotime($request->date_of_birth)); 
            $user->save();

            return redirect('editprofile/'. $id)->with('status', 'Chỉnh sửa thông tin thành công');
        } else {
            $user->name = $request->name;
            $user->name = $this->user->htmlEntities($user->name);
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->address = $this->user->htmlEntities($user->address);
            $user->date_of_birth = date('Y-m-d',strtotime($request->date_of_birth)); 
            $user->save();

            return redirect('editprofile/'. $id)->with('status', 'Chỉnh sửa thông tin thành công');

        }  
        
    }
    //Get User Change password

    public function getChangePass()
    {
        return view('user.pages.change_pass');
    }

    public function postChangePass( ChangePassRequest $request)
    {
        if(Auth::check())
        {
            $input = $request->all();
            $user = Auth()->user();

            if(!\Hash::check($input['passwordOld'], $user->password)){
                return back()->with('notify', 'Bạn không thể thay đổi mật khẩu');
            }else{
                Auth::user()->password = bcrypt(Input::get('password'));
                Auth::user()->save();

                return back()->with('status', 'Thay đổi mật khẩu thành công');
            }
        }
    }
}
