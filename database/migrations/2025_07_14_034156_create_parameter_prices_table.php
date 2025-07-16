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
        Schema::create('parameter_prices', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable(); // Unique company price code
            $table->string('parameter')->nullable();      // Name of the parameter
            $table->string('test_duration')->nullable();
            $table->float('price', 8, 2)->nullable();      // Floating price (e.g., 999999.99)
            $table->string('lab_type')->nullable();       // Type of lab
            $table->unsignedBigInteger('parameter_id')->nullable(); // Foreign key

            $table->foreign('parameter_id')
                ->references('id')
                ->on('parameters')
                ->nullOnDelete(); // Optional: If parameter is deleted, null the FK

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameter_prices');
    }
};
