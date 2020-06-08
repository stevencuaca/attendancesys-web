<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Salary extends Model
{
    public $table = "salary";

    public $fillable = ['employee_id', 'from_date', 'to_date', 'total_date','total_deduction', 'bonus', 'salary', 'total_absence'];
}
