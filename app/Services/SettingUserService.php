<?php
namespace App\Services;

use App\Repositories\SettingUserRepository;
use App\Models\SettingUser;
use DB;
use Input;
use App\Http\Controllers\MyConstant;

class SettingUserService extends BaseService implements SettingUserRepository {

	public function __construct(SettingUser $model)
    {
        $this->model = $model;
    }

    public function getSettingUser(){
    	return DB::table('setting_users')->get();
    }

    public function getSettingFromUserId($user_id){
    	return DB::table('setting_users')->where('user_id', '=', $user_id)->first();
    }

    public function getTimeReminderFromUserId($user_id){
    	return SettingUser::where('user_id', '=', $user_id)->first()->timeReminder->toArray();
    }

    public function getWordUserFromUserId($user_id){
    	return DB::table('word_users')->where('user_id', '=', $user_id)->where('is_notification', '=', 1)->get();
    }

    public function getTypeReminderFromUserId($user_id){
    	return SettingUser::where('user_id', '=', $user_id)->first()->typeReminder->toArray();
    }
}

