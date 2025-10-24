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
            // حذف foreign key أولاً
            $table->dropForeign(['injection_id']);

            // حذف الأعمدة
            $table->dropColumn([
                'eye_side',
                'status',
                'injection_id',
                'total_dose',
                'remaining_dose'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            // إعادة إضافة الأعمدة في حالة التراجع
            $table->enum('eye_side', ['يمين', 'يسار', 'يمين+يسار'])->nullable()->after('sector');
            $table->enum('status', ['pending', 'complete', 'review'])->default('pending')->after('doctor_id');
            $table->foreignId('injection_id')->nullable()->constrained('injections')->onDelete('set null')->after('status');
            $table->integer('total_dose')->nullable()->after('injection_id');
            $table->integer('remaining_dose')->nullable()->after('total_dose');
        });
    }
};
