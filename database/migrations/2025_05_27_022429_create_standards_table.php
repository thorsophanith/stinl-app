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
        Schema::create('standards', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('cs')->nullable();
            $table->string('codex')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_kh')->nullable();
            $table->enum('lab_type', ['Microbiological', 'Chemical', 'Others']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standards');
    }
};
