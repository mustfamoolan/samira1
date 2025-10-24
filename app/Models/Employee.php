<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'phone',
        'password',
        'photo',
        'department_id',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'password' => 'hashed',
    ];

    // تحديد الحقل المستخدم للمصادقة
    public function getAuthIdentifierName()
    {
        return 'phone';
    }

    // علاقة مع القسم
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
