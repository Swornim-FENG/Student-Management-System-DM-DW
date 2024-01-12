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
        Schema::create('grades', function (Blueprint $table) {
            $table->unsignedBigInteger('prof_id');
            $table->foreign('prof_id')->references('user_id')->on('professors');
            $table->unsignedBigInteger('stud_id');
            $table->foreign('stud_id')->references('user_id')->on('students');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('course_id')->on('course');
            $table->enum('year',["1st","2nd","3rd","4th","5th"]);
            $table->enum('sem',["1st","2nd"]);
            $table->string('batch', 255);
            $table->string('first_internal', 50);
            $table->string('second_internal', 50);
            $table->string('assignments', 50);
            $table->string('presentation', 50);
            $table->string('mcq', 50);
            $table->string('extra_credit', 50);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
