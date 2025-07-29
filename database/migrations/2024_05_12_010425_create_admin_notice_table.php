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
        
        Schema::create('admin_notice', function (Blueprint $table) {
            $table->id('notice_id');
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('program_id')->references('program_id')->on('program');
            $table->string('notice_file')->nullable();
            $table->string('notice_heading', 50);
            $table->string('notice_description', 500);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_notice');
    }
};
