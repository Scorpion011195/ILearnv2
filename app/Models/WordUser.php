<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordUser extends Model
{
    //
    protected $table="word_users";
    protected $primaryKey = 'id';

    protected $fillable = [
    'user_id', 'word', 'mean', 'type_word', 'lang_pair_name', 'from_language_id', 'to_language_id', 'is_notification'];

    function User()
    {
    	return $this->hasMany('User','user_id');
    }
    function Language()
    {
    	return $this->belongsTo('Language', 'from_language_id','to_language_id');
    }
}
