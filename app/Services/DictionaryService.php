<?php
namespace App\Services;

use App\Models\Dictionary;
use App\Repositories\DictionaryRepository;
use DB;

class DictionaryService extends BaseService implements DictionaryRepository
{
    public function __construct(Dictionary $model)
    {
        $this->model = $model;
    }

    public function checkWordExist($word, $typeWord, $languageId)
    {
    	$result = DB::table('dictionarys')->where('word', '=', $word)->where('type_word', '=', $typeWord)->where('language_id','=', $languageId)->get();
    	$count = $result->count();
	    if($count > 0){
        	return true;
	    }
	    else{
	        // Word doesn't exist in from-table
	        return false;
	    }
    }

    public function getMappingId($word, $typeWord, $languageId){
        $result = DB::table('dictionarys')->where('word', '=', $word)->where('type_word', '=', $typeWord)->where('language_id','=', $languageId)->first();

        return $result->mapping_id;
    }

    public function getMaxMappingId(){
        $result = DB::table('dictionarys')->max('mapping_id');

        return ++$result;
    }

    public function getIsUpload(){
        $result = DB::table('is_upload_dictionarys')->find(1);
        return $result->is_upload;
    }

    public function setIsUpload($isUpload){
        DB::table('is_upload_dictionarys')->where('id', 1)->update(['is_upload' => $isUpload]);
    }
}

