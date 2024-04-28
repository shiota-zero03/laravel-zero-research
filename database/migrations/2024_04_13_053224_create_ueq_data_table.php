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
        Schema::create('ueq_data', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('ticket_id')->unsigned();
            $table->foreign('ticket_id')->references('id')->on('ticket_data')->onDelete('cascade');
            $table->string('q1')->nullable();
            $table->string('q2')->nullable();
            $table->string('q3')->nullable();
            $table->string('q4')->nullable();
            $table->string('q5')->nullable();
            $table->string('q6')->nullable();
            $table->string('q7')->nullable();
            $table->string('q8')->nullable();
            $table->string('q9')->nullable();
            $table->string('q10')->nullable();
            $table->string('q11')->nullable();
            $table->string('q12')->nullable();
            $table->string('q13')->nullable();
            $table->string('q14')->nullable();
            $table->string('q15')->nullable();
            $table->string('q16')->nullable();
            $table->string('q17')->nullable();
            $table->string('q18')->nullable();
            $table->string('q19')->nullable();
            $table->string('q20')->nullable();
            $table->string('q21')->nullable();
            $table->string('q22')->nullable();
            $table->string('q23')->nullable();
            $table->string('q24')->nullable();
            $table->string('q25')->nullable();
            $table->string('q26')->nullable();
            $table->string('attractiveness')->nullable();
            $table->string('perspicuity')->nullable();
            $table->string('efficiency')->nullable();
            $table->string('dependability')->nullable();
            $table->string('stimulation')->nullable();
            $table->string('novelty')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ueq_data');
    }
};
