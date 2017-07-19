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

    public function checkWordExist($word, $typeWordId, $languageId)
    {
    	$result = DB::table('dictionarys')->where('word', '=', $word)->where('type_word_id', '=', $typeWordId)->where('language_id','=', $languageId)->get();
    	$count = $result->count();
	    if($count > 0){
        	return true;
	    }
	    else{
	        // Word doesn't exist in from-table
	        return false;
	    }
    }

    public function getMappingId($word, $typeWordId, $languageId){
        $result = DB::table('dictionarys')->where('word', '=', $word)->where('type_word_id', '=', $typeWordId)->where('language_id','=', $languageId)->first();

        return $result->mapping_id;
    }

    public function getMaxMappingId(){
        $result = DB::table('dictionarys')->max('mapping_id');

        return ++$result;
    }
}

