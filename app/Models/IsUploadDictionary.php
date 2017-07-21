<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class IsUploadDictionary extends Model
{
    protected $table = "is_upload_dictionarys";
    protected $fillable = ['id', 'is_upload'];
}
