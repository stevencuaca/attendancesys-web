<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    public $table = "employee";

    public $fillable = ['face_id', 'first_name', 'last_name', 'employee_id','base_salary'];

}
