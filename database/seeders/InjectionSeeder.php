<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Injection;

class InjectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $injections = [
            [
                'name' => 'حقنة أفاستين',
                'description' => 'حقنة لعلاج أمراض الشبكية',
                'is_active' => true,
            ],
            [
                'name' => 'حقنة لوسنتس',
                'description' => 'حقنة لعلاج الضمور البقعي',
                'is_active' => true,
            ],
            [
                'name' => 'حقنة إيليا',
                'description' => 'حقنة لعلاج الوذمة البقعية',
                'is_active' => true,
            ],
            [
                'name' => 'حقنة أوزوردكس',
                'description' => 'حقنة لعلاج التهاب القزحية',
                'is_active' => true,
            ],
            [
                'name' => 'حقنة تريامسينولون',
                'description' => 'حقنة كورتيزون لعلاج الالتهابات',
                'is_active' => true,
            ],
        ];

        foreach ($injections as $injection) {
            Injection::create($injection);
        }
    }
}
