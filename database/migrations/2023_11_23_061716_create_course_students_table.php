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
    
        Schema::create('course_students', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('course_id')->on('course');
            $table->unsignedBigInteger('stud_id');
            $table->foreign('stud_id')->references('user_id')->on('students');
            $table->enum('year',["1st","2nd","3rd","4th","5th"]);
            $table->enum('sem',["1st","2nd"]);
            $table->string('batch', 255);
            $table->primary(['course_id', 'stud_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_students');
    }
};
