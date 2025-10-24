<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // التحقق من وجود البيانات المكررة أولاً وحذفها
        DB::statement('
            DELETE t1 FROM patients t1
            INNER JOIN patients t2
            WHERE t1.id > t2.id
            AND t1.national_id = t2.national_id
        ');

        // التحقق من وجود unique constraint قبل إضافته
        $indexes = DB::select("SHOW INDEX FROM patients WHERE Key_name = 'patients_national_id_unique'");

        if (empty($indexes)) {
            Schema::table('patients', function (Blueprint $table) {
                $table->unique('national_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropUnique(['national_id']);
        });
    }
};
