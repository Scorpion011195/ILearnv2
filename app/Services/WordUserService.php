<?php
namespace App\Services;

use App\Repositories\WordUserRepository;
use App\Models\WordUser;
use DB;

class WordUserService extends BaseService implements WordUserRepository {

	public function __construct(WordUser $model){
        $this->model = $model;
    }

    public function getLanguages()
    {
    	return DB::table('languages')->get();
    }

    public function getTypeWord()
    {
    	return DB::table('type_words')->select('name_type_word')->get();
    }
    public function getWordUser()
    {
    	return DB::table('word_users')->get();
    }

    public function checkWordUserExist($word, $mean, $type_word, $lang_pair_name)
    {
    	$result = DB::table('word_users')->where('word', '=', $word)->where('mean', '=', $mean)->where('type_word', '=', $type_word)->where('lang_pair_name', '=', $lang_pair_name)->get();
        $count = $result->count();
        if($count > 0){
            return true;
        }
        else{
            // Word doesn't exist in from-table
            return false;
        }
    }

}