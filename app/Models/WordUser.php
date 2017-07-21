<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordUser extends Model
{
    //
    protected $table="word_users";
    protected $primaryKey = 'id';

    protected $timestamp = False;

    protected $fillable = [
    'user_id', 'mean', 'type_word_id','from_language_id','to_language_id','is_notification'];

    function User()
    {
    	return $this->hasMany('User','user_id');
    }
    function TypeWord()
    {
    	return $this->hasMany('TypeWord','type_word_id');
    }
    function Language()
    {
    	return $this->belongsTo('Language', 'from_language_id','to_language_id');
    }
}
