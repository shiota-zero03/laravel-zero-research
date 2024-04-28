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
        Schema::create('item_validations', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('item_groups')->onDelete('cascade');
            $table->string('item_name')->nullable();
            $table->string('qualification')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_validations');
    }
};
