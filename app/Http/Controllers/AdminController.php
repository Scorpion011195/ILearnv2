<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
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
            $languageService = new LanguageService(new Language);
            $listLanguage = $languageService->getAll();

            $listTypeOfWord = MyConstant::TYPE_OF_WORD_VIETNAMESE;

            $param = ['listLanguage'=>$listLanguage,'listTypeOfWord'=>$listTypeOfWord,'idTableNguon'=> 1,'idTableDich'=>2,'idLoaiTu'=>6, 'lastTxtTu'=>'', 'lastTxtNghia'=>'', 'code'=>'none'];
            return view('backend.pages.dict.create', $param);
        }
        else{
            return view('backend.pages.login');
        }
    }

    function postLogin(AdminLoginRequest $request)
    {
        $username = $request['username'];
        $password = $request['password'];

        $check = ['username'=>$username,'password'=>$password,'id_status'=>1];

        if(Auth::attempt($check)&&(Auth::user()->id_role!=MyConstant::ROLE['user'])){
            Session::put('user', Auth::user());
            return redirect()->route('adminHome');
        }
        else{
            $errors = new MessageBag(['errorLogin' => 'Username hoặc Password không đúng']);
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
        $column = 'id_user';
        $value = Session::get('user')->id_user;

        $userInformationService = new UserInformationService(new UserInformation);
        $profile = $userInformationService->getByColumn($column, $value);

        // Check if exist personal information
        if(!isset($profile)){
            $userInformationService->create(['id_user' => $value]);

            $profile = $userInformationService->getByColumn($column, $value);
        }

        return view('backend.pages.user.profile.profile',['profile'=>$profile]);
    }

    function updateProfile(AdminPersonalInformationRequest $request)
    {
        $column = 'id_user';
        $value = Session::get('user')->id_user;

        // Input
        $name = $request['profile-name'];
        $address = $request['profile-address'];
        $phone = $request['profile-phone'];
        $dateOfBirth = date('Y-m-d', strtotime($request['profile-dob']));

        // If profile-name invalidate
        if(!DictionaryManagementController::checkValidate($name)){
            $errors = new MessageBag(['profile-name' => 'Tên không hợp lệ!']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
        // If profile-address invalidate
        if(!DictionaryManagementController::checkValidate($address)){
            $errors = new MessageBag(['profile-address' => 'Địa chỉ không hợp lệ!']);
            return redirect()->back()->withInput()->withErrors($errors);
        }

        $attributes = ['name'=>$name, 'address'=>$address, 'phone'=>$phone, 'date_of_birth'=>$dateOfBirth];

        $userInformationService = new UserInformationService(new UserInformation);
        $userInformationService->updateByColumn($column, $value, $attributes);

        return redirect()->route('adminProfile')->with('alertUpdateProfile','Cập nhật thành công!');
    }

    function getChangePassword(){
        return view('backend.pages.user.change-password.change-password');
    }

    function postChangePassword(AdminResetPasswordRequest $request)
    {
        $password = Session::get('user')->password;

        $passwordOld = $request['profile-password-old'];
        $passwordNew = $request['profile-password-new'];
        $passwordNewConfirm = $request['profile-password-new-confirm'];

        if (Hash::check($passwordOld, $password))
        {
            if($passwordNew==$passwordNewConfirm)
            {
                $column = 'id_user';
                $value = Session::get('user')->id_user;

                $attributes = ['password'=>bcrypt($passwordNewConfirm)];

                $userService = new UserService(new User);
                $userService->updateByColumn($column, $value, $attributes);

                return redirect()->route('adminGetChangePassword')->with('alertUpdatePassword','success');
            }
            else
                return redirect()->route('adminGetChangePassword')->with('alertUpdatePassword','failPassConfirm');
        }
        else
            return redirect()->route('adminGetChangePassword')->with('alertUpdatePassword','failPass');

    }
}
