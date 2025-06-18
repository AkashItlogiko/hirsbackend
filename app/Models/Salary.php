<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_card_no',
        'employee_name',
        'designation',
        'department',
        'net_salary',
        'pay_date',
    ];
}
