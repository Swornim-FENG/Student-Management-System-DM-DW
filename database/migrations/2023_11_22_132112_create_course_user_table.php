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
    
        Schema::create('course_user', function (Blueprint $table) {
            $table->unsignedBigInteger('prof_id');
            $table->foreign('prof_id')->references('user_id')->on('professors');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('course_id')->on('course');
            $table->unsignedBigInteger('dep_id');
            $table->foreign('dep_id')->references('dep_id')->on('department');
            $table->unsignedBigInteger('stud_id');
            $table->foreign('stud_id')->references('user_id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_user');
    }
};
