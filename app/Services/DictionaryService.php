<?php
namespace App\Services;

use App\Repositories\DictionaryRepository;
use App\Models\Dictionary;
use DB;
use Input;
use App\Http\Controllers\MyConstant;

class DictionaryService extends BaseService implements DictionaryRepository {

    

	public function __construct(Dictionary $model)
    {
        $this->model = $model;
    }
    public function findWord($inputText)

    {
        
        $valueLang = Input::get('lagFrom');
        $fromLanguage = MyConstant::LANGUAGE_FORM_LANGPAIR[$valueLang];
    	$lagInfor = DB::table('dictionarys')->select('mapping_id', 'language_id')->where('word', '=', $inputText)->where('language_id', '=', $fromLanguage)->get();

    	$lagMapping = array();

    	for($i = 0; $i < count($lagInfor); $i++)
    	{
    		if(!isset($lagInfor[$i]))
    		{
    			return false;
    		}
    		else 
    		{
    			//Get Word
                switch ($valueLang) {
                    case 31:
                        $lagResult = DB::table('dictionarys')->select('id', 'word', 'pronounce','listen', 'explain', 'type_word','mapping_id','language_id')->where('mapping_id', '=', $lagInfor[$i]->mapping_id)->where('language_id', '=', MyConstant::LANGUAGE['Anh'])->orderby('word','asc')->get();
                        array_push($lagMapping, $lagResult);
                        break;
                    case 13:
                        $lagResult = DB::table('dictionarys')->select('id', 'word', 'pronounce','listen', 'explain', 'type_word','mapping_id','language_id')->where('mapping_id', '=', $lagInfor[$i]->mapping_id)->where('language_id', '=', MyConstant::LANGUAGE['Việt'])->orderby('word','asc')->get();
                    array_push($lagMapping, $lagResult);
                    break;  
                    default;
                    break;              
                    }
    		}
    	}
    	return $lagMapping;
    }

    public function findWordSeft($inputText)
    {
        $valueLang = Input::get('lagFrom');
        $fromLanguage = MyConstant::LANGUAGE_FORM_LANGPAIR[$valueLang];

        return DB::table('dictionarys')->where('word', '=', $inputText)->where('language_id', '=', $fromLanguage)->get();
    }

    public function findWordRelated($inputText)
    {
        $valueLang = Input::get('lagFrom');
        $fromLanguage = MyConstant::LANGUAGE_FORM_LANGPAIR[$valueLang];

        $langRelate = DB::table('dictionarys')->select('mapping_id', 'language_id');
    }
}