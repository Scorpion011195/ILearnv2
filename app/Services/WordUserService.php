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
    	   return DB::table('type_words')->distinct()->select('name_type_word', 'language_id')->groupBy('name_type_word')->get();  
    }

    public function getTypeWordByType($type)
    {
        return DB::table('type_words')->distinct()->select('name_type_word', 'language_id')->where('language_id', '=',  $type)->groupBy('name_type_word')->get();    
    }

    public function getWordUser($user_id)
    {
    	return DB::table('word_users')->where('user_id', '=', $user_id)->paginate(5);
    }

    public function getTypeReminder()
    {
        return DB::table('type_reminders')->get();
    }

    public function getTimeReminder()
    {
        return DB::table('time_reminders')->get();
    }

    public function getSettingUser($user_id)
    {
        return DB::table('setting_users')->where('user_id', '=', $user_id)->first();
    }

    public function checkWordUserExist($word, $mean, $type_word, $lang_pair_name, $userId)
    {
    	$result = DB::table('word_users')->where('word', '=', $word)->where('mean', '=', $mean)->where('type_word', '=', $type_word)->where('user_id', '=', $userId)->where('lang_pair_name', '=', $lang_pair_name)->get();
        $count = $result->count();
        if($count > 0){
            return true;
        }
        else{
            // Word doesn't exist in from-table
            return false;
        }
    }

    //Find id by colums
    public function findIdByColums($word, $mean, $type_word, $lang_pair_name, $userId){
        $result = DB::table('word_users')->where('word', '=', $word)->where('mean', '=', $mean)->where('type_word', '=', $type_word)->where('lang_pair_name', '=', $lang_pair_name)->where('user_id', '=', $userId)->first();
        return $result->id;
    }
}