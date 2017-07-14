<?php
/**
 * Created by PhpStorm.
 * User: silverhawk
 * Date: 08/06/2017
 * Time: 08:33
 */
namespace App\Repositories;

interface DictionaryManagementRepository extends BaseRepository {
    
    public function search($phrase, $source, $dest);

}