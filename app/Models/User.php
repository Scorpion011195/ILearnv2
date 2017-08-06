<?php
namespace App\Models;
use \App\Http\Requests\RegisterRequest;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\UserRole;
use App\Models\settingUser;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = "users";
    protected $primaryKey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'confirmed',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function userRole(){
        return $this->belongsTo('App\Models\UserRole','role_id','role_id');
    }

    public function settingUser()
    {
        return $this->hasOne('settingUser','user_id');
    }
}
