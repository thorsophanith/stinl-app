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
        Schema::create('standard_parameters', function (Blueprint $table) {
            $table->id();

            // Foreign key to standards
            $table->foreignId('standard_id')->constrained('standards')->onDelete('cascade');

            // Foreign key to parameters
            $table->foreignId('parameter_id')->constrained('parameters')->onDelete('cascade');

            // Optional: make the pair unique to prevent duplicates
            $table->unique(['standard_id', 'parameter_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standard_parameters');
    }
};
