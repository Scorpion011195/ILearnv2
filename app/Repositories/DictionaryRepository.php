<?php
namespace App\Repositories;

interface DictionaryRepository{

    function findWord($inputText);
}