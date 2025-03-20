<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->unsignedBigInteger('course_id'); // Foreign key to courses table
            $table->string('day', 20); // Day of the schedule (e.g., Monday)
            $table->time('start_time'); // Start time of the class
            $table->time('end_time'); // End time of the class
            $table->string('instructor', 255); // Instructor's name
            $table->string('location', 255); // Location of the class
            $table->timestamps(); // created_at & updated_at

            // Foreign key constraint
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timetables');
    }
};
