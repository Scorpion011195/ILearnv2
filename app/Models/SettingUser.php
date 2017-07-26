<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingUser extends Model
{
    //
    protected $table = 'setting_users';
    protected $primaryKey = 'id';
    protected $timestamp = False;

    protected $fillable = [
	'user_id', 'time_reminder_id', 'type_reminder_id', 'isOn'
    ];

    function User()
    {
   		return $this->belongsTo('App\Models\User','user_id');
    }

    function timeReminder()
    {
    	return $this->belongsTo('App\Models\TimeReminder', 'time_reminder_id', 'id');
    }
    function typeReminder()
    {
    	return $this->belongsTo('App\Models\TypeReminder','type_reminder_id', 'id');
    }

}
