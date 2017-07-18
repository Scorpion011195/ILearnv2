<?php

namespace App\models;

use App\Models\typeWord;
use App\models\language;

use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
   protected $table = "dictionarys";
   protected $primaryKey = "id";

   function typeWord(){
   	return $this->belongsTo('App\Models\TypeWord','type_word_id','type_word_id');
   }
   function language(){
   	return $this->belongsTo('App\Models\Language','language_id','language_id');
   }
    protected $table = "dictionarys";
    protected $fillable = [
        'id','word', 'pronounce', 'type_word_id','language_id','listen','explain','mapping_id'
    ];

}
