<?php

namespace App\models;

use App\Models\typeWord;
use App\models\language;

use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
   protected $table = "dictionarys";
   protected $primaryKey = "id";

   protected $fillable = [
        'word', 'pronounce', 'type_word', 'language_id', 'listen', 'explain', 'mapping_id'
    ];

   function language(){
   	return $this->belongsTo('App\Models\Language','language_id','language_id');
   }
}
