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
        //departments
        Schema::create('department', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('department');
            $table->timestamps();
        });

        Schema::create('courses', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('department_id');
            $table->string('course');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department');
    }
};
