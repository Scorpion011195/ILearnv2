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

    public function getMappingId($word, $typeWord, $languageId)
    {
        $result = DB::table('dictionarys')->where('word', '=', $word)->where('type_word', '=', $typeWord)->where('language_id','=', $languageId)->first();

        return $result->mapping_id;
    }

    public function getMaxMappingId()
    {
        $result = DB::table('dictionarys')->max('mapping_id');

        return ++$result;
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

       $arrResultSearch = array();

       array_push($arrResultSearch, $valueLang);
       array_push($arrResultSearch, $lagMapping);
       
        return $arrResultSearch; 
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
        return DB::table('dictionarys')->where('word', 'LIKE', $inputText[0].'%')->where('language_id' ,'=' , $fromLanguage)->take(10)->get();

         // return DB::table('dictionarys')->whereRaw('MATCH(word) AGAINST(?)', array($inputText))->orderby('word','asc')->get();

        // $langRelate = DB::table('dictionarys')->whereRaw("MATCH(word) AGAINST(? IN BOOLEAN MODE)", array($inputText))->orderby('word','asc')->get();

    }

    public function getIsUpload(){
        $result = DB::table('is_upload_dictionarys')->find(1);
        return $result->is_upload;
    }

    public function setIsUpload($isUpload){
        DB::table('is_upload_dictionarys')->where('id', 1)->update(['is_upload' => $isUpload]);
    }
}

