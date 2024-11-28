<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique()->nullable();
            $table->text('description')->nullable();
            $table->string('thumb')->nullable();
            $table->string('position', 255)->nullable();
            $table->string('location')->nullable();
            $table->text('requirements')->nullable();
            $table->string('type', 255)->nullable();
            $table->foreignId('job_categories_id')->constrained('job_categories');
            $table->string('salary', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
