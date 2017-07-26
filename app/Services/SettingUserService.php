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
}

