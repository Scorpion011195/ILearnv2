<?php

namespace App\Services;

use App\Model\DictionaryManagement;
use App\Repositories\DictionaryManagementRepository;

class DictionaryService extends BaseService implements DictionaryRepository
{
    public function __construct(Dictionary $model)
    {
        parent::__construct($model);
    }

    public function search($phrase, $source, $dest)
    {

    }

}

