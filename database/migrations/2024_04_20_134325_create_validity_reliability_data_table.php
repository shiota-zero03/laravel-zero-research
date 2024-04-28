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
        Schema::create('validity_reliability_data', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('ticket_id')->unsigned();
            $table->foreign('ticket_id')->references('id')->on('ticket_data')->onDelete('cascade');
            $table->BigInteger('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('item_validations')->onDelete('cascade');
            $table->string('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validatity_reliability_data');
    }
};
