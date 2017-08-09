<?php
namespace App\Repositories;

interface WordUserRepository extends BaseRepository {
	
    function getLanguages();
    function getTypeWord();
    function getTypeWordByType($type);
    function checkWordUserExist($word, $mean, $type_word, $lang_pair_name, $userId);
    function findIdByColums($word, $mean, $type_word, $lang_pair_name, $userId);
}