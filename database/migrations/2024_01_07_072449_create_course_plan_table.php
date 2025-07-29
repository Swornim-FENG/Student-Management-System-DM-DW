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
        
        Schema::create('course_plan', function (Blueprint $table) {
            $table->unsignedBigInteger('prof_id');
            $table->foreign('prof_id')->references('user_id')->on('professors');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('course_id')->on('course');
            $table->enum('year',["1st","2nd","3rd","4th","5th"]);
            $table->enum('sem',["1st","2nd"]);
            $table->string('batch', 255);
            $table->string('course_description', 500);
            $table->string('grading_guideline', 500);
            $table->string('course_plan')->nullable();
            $table->timestamps();
            $table->primary(['course_id', 'batch']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_plan');
    }
};
