<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_card_number',
        'employee_name',
        'designation',
        'department',
        'email',
        'phone_number',
        'address',
    ];
}
