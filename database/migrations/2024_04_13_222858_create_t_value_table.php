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
        Schema::create('t_value', function (Blueprint $table) {
            $table->id();
            $table->string('item')->nullable();
            $table->string('t0_1')->nullable();
            $table->string('t0_05')->nullable();
            $table->string('t0_02')->nullable();
            $table->string('t0_01')->nullable();
            $table->string('t0_002')->nullable();
            $table->string('t0_001')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_value');
    }
};
