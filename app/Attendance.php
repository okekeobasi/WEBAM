<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';

    public function users(){
        return $this->hasOne('App\User','staffId');
    }

    public function department(){
        return $this->hasOne('App\Department','id');
    }
}
