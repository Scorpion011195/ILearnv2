<?php

namespace App\Services;

use App\Repositories\DictionaryRepository;
use App\Models\Dictionary;

class DictionaryService extends BaseService implements DictionaryRepository {

	public function __construct(Language $model)
    {
        $this->model = $model;
    }
}