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

    function TimeReminder()
    {
    	return $this->belongsTo('TimeReminder', 'time_reminder_id');
    }
    function TypeReminder()
    {
    	return $this->belongsTo('TypeReminder','type_reminder_id');
    }

}
