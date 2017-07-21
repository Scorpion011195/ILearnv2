<?php
namespace App\Services;

use App\Models\IsUploadDictionary;
use App\Repositories\IsUploadDictionaryRepository;

class IsUploadDictionaryService extends BaseService implements IsUploadDictionaryRepository{

    public function __construct(IsUploadDictionary $model){
        $this->model = $model;
    }
}
