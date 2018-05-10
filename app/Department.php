<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "department";

    public function user(){
        return $this->belongsTo('App\User','departmentId');
    }

    public function attendance(){
        return $this->belongsTo('App\Attendance', 'id');
    }
}
