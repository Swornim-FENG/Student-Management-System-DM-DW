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
    
        Schema::create('program_professors', function (Blueprint $table) {
            $table->unsignedBigInteger('program_id');
            $table->foreign('program_id')->references('program_id')->on('program');
            $table->unsignedBigInteger('prof_id');
            $table->foreign('prof_id')->references('user_id')->on('professors');
            $table->primary(['program_id', 'prof_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_professors');
    }
};
