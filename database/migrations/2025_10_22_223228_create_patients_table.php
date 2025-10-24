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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('full_name'); // الاسم الرباعي
            $table->string('national_id')->unique(); // الرقم الوطني
            $table->string('country')->default('العراق'); // البلد
            $table->string('province'); // المحافظة
            $table->integer('age'); // العمر
            $table->string('phone'); // رقم الهاتف
            $table->enum('gender', ['ذكر', 'أنثى']); // الجنس
            $table->enum('sector', ['حكومي', 'عتبة']); // القطاع
            $table->string('bus_fee')->nullable(); // رسوم الباص
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade'); // الطبيب
            $table->enum('status', ['pending', 'complete', 'review'])->default('pending'); // الحالة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
