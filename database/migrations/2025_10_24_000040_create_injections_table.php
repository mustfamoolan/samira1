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
        Schema::create('injections', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم الحقنة
            $table->text('description')->nullable(); // وصف الحقنة
            $table->boolean('is_active')->default(true); // حالة الحقنة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('injections');
    }
};
