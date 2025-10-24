<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            // ملفات التشخيص والسونار
            $table->string('diagnosis_file')->nullable()->after('status'); // ملف التشخيص (إجباري لاحقاً)
            $table->string('sonar_file')->nullable()->after('diagnosis_file'); // ملف السونار (اختياري)

            // معلومات الحقن
            $table->foreignId('injection_id')->nullable()->constrained('injections')->onDelete('set null')->after('sonar_file'); // الحقنة المختارة
            $table->integer('total_dose')->nullable()->after('injection_id'); // الجرعة الكلية
            $table->integer('remaining_dose')->nullable()->after('total_dose'); // الجرعة المتبقية
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropForeign(['injection_id']);
            $table->dropColumn(['diagnosis_file', 'sonar_file', 'injection_id', 'total_dose', 'remaining_dose']);
        });
    }
};
