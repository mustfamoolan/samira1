<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'national_id',
        'country',
        'province',
        'age',
        'phone',
        'gender',
        'sector',
        'bus_fee',
        'doctor_id',
        'diagnosis_file',
        'sonar_file'
    ];

    protected $casts = [
        'age' => 'integer',
    ];

    // علاقة مع الطبيب
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

}
