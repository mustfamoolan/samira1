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
        'eye_side',
        'bus_fee',
        'doctor_id',
        'status',
        'diagnosis_file',
        'sonar_file',
        'injection_id',
        'total_dose',
        'remaining_dose'
    ];

    protected $casts = [
        'age' => 'integer',
        'total_dose' => 'integer',
        'remaining_dose' => 'integer',
    ];

    // علاقة مع الطبيب
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // علاقة مع الحقنة
    public function injection()
    {
        return $this->belongsTo(Injection::class);
    }
}
