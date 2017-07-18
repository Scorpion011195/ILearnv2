<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
    protected $table = 'languages';
    protected $timestamp = False;

    protected $primaryKey = "id";

     protected $fillable = [
        'name_language', 'code_language',
    ];
}
