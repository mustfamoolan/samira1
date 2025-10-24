<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_logo'
    ];

    /**
     * الحصول على إعدادات الموقع (سجل واحد فقط)
     */
    public static function getSettings()
    {
        return self::first() ?? self::create([
            'site_name' => 'نظام إدارة المستشفى',
            'site_logo' => null
        ]);
    }

    /**
     * تحديث إعدادات الموقع
     */
    public static function updateSettings($data)
    {
        $settings = self::getSettings();
        $settings->update($data);
        return $settings;
    }
}
