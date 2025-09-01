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
        'nid_number',
        'department_id',
        'profile_photo',
        'joining_date',
        'email',
        'phone_number',
        'present_address',
        'permanent_address'
    ];

     public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    public function salary()
    {
        return $this->hasMany(Salary::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
