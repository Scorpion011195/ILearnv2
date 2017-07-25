<?php
namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\User;
use DB;
use Input;
use App\Http\Controllers\MyConstant;

class UserService extends BaseService implements UserRepository {

	public function __construct(User $model)
    {
        $this->model = $model;
    }
}

