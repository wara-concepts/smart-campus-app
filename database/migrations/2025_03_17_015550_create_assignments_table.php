<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->enum('status', ['Pending', 'Completed'])->default('Pending');
            $table->date('deadline');
            $table->string('submission')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assignments');
    }
};
