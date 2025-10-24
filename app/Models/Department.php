<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'department_type',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // علاقة مع مسؤولي الأقسام
    public function departmentManagers()
    {
        return $this->hasMany(DepartmentManager::class);
    }

    // علاقة مع الموظفين
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
