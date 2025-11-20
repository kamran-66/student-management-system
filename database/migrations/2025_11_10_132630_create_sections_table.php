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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('academic_year_id')->nullable();
            $table->unsignedBigInteger('course_id')->nullable();
            
            $table->foreign('academic_year_id')
              ->references('id')
              ->on('academic_year')
              ->onDelete('set null');


            $table->foreign('course_id')
              ->references('id')
              ->on('courses')
              ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
