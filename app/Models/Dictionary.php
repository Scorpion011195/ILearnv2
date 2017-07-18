<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    protected $table = "dictionarys";
    protected $fillable = [
        'id','word', 'pronounce', 'type_word_id','language_id','listen','explain','mapping_id'
    ];
}
