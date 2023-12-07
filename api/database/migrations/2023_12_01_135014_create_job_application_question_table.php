<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_application_question', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_application_id')->references('id')->on('job_applications');
            $table->foreignId('question_id')->nullable()->references('id')->on('questions');
            $table->tinytext('custom_question')->nullable();
            $table->text('answer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_application_question');
    }
};