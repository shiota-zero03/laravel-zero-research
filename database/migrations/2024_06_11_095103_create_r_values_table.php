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
        Schema::create('r_values', function (Blueprint $table) {
            $table->id();
            $table->string('item')->nullable();
            $table->string('r_01')->nullable();
            $table->string('r_005')->nullable();
            $table->string('r_002')->nullable();
            $table->string('r_001')->nullable();
            $table->string('r_0001')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_values');
    }
};
