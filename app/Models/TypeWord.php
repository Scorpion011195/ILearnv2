<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TypeWord extends Model
{

    protected $table = 'type_words';
    protected $timestamp = False;

    protected $primaryKey = 'id';

     protected $fillable = [
        'name_type_word',
    ];
    
    function language()
    {
    	return $this->belongsTo('Language','language_id');
    }
}
