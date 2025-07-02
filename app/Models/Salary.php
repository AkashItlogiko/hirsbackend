<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'department_id',
        'pay_date',
        'net_salary',
    ];

   public function employee()
   {
    return $this->belongsTo(Employee::class);
   }

   public function department()
   {
    return $this->belongsTo(Department::class);
   }

}
