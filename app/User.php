<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'firstname', 'lastname', 'email', 'password', 'department', 'phone', 'status', 'username', 'roleId'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $primaryKey = "staffId";

    public function roles(){
        return $this->hasOne('App\Role','id');
    }

    public function department(){
        return $this->hasOne('App\Department', 'id');
    }

    public function attendance(){
        return $this->belongsTo('App\Attendance', 'id');
    }
}
