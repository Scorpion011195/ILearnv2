<?php
namespace App\Services;

use App\Repositories\WordUserRepository;
use App\Models\WordUser;
use DB;

class WordUserService extends BaseService implements WordUserRepository {

	public function __construct(WordUser $model){
        $this->model = $model;
    }
    public function getLanguage()
    {
    	return DB::table('languages')->select('name_language')->get();
    }
    public function getTypeWord()
    {
    	
    }
}