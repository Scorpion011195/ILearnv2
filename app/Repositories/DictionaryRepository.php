<?php
namespace App\Repositories;

interface DictionaryRepository extends BaseRepository {
    
    public function checkWordExist($word, $typeWordId, $languageId);

}