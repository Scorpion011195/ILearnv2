<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SettingUsers extends Model
{
    //
    protected $table ="setting_users";
    protected $primaryKey = 'id';

    public $timestamps = false;

    public function User()
    {
    	return $this->belongsTo('Users', 'user_id');
    }
}

