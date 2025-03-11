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

        Schema::create('class_rooms', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('department_id');
            $table->integer('capacity');
            $table->timestamps();
        });

        Schema::create('resources', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('department_id');
            $table->string('name');
            $table->integer('qty');
            $table->timestamps();
        });

        Schema::create('resource_reserve', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('resource_id');
            $table->foreignId('user_id');
            $table->dateTime('request_dateTime', precision: 0);
            $table->dateTime('handover_dateTime', precision: 0);
            $table->string('status');
            $table->integer('qty');
            $table->timestamps();
        });

        Schema::create('class_reserve', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('class_id');
            $table->foreignId('user_id');
            $table->dateTime('request_dateTime', precision: 0);
            $table->dateTime('handover_dateTime', precision: 0);
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->foreignId('user_id');
            $table->dateTime('request_dateTime', precision: 0);
            $table->dateTime('handover_dateTime', precision: 0);
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('class_rooms');
        Schema::dropIfExists('resources');
        Schema::dropIfExists('resource_reserve');
        Schema::dropIfExists('class_reserve');
        Schema::dropIfExists('events');
    }
};
