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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();

            $table->string('file_path');
            $table->foreignId('candidate_id')->references('id')->on('candidates');
            $table->foreignId('headquarter_id')->references('id')->on('headquarters');
            $table->foreignId('job_position_id')->references('id')->on('job_positions');
            $table->foreignId('acquisition_channel_id')->references('id')->on('acquisition_channels');
            $table->dateTime('date')->nullable();
            $table->string('videocall_link')->nullable();
            $table->boolean('performed')->default(0);
            $table->foreignId('job_application_result_id')->nullable()->references('id')->on('job_application_results');
            $table->foreignId('job_application_rejection_reason_id')->nullable()->references('id')->on('job_application_rejection_reasons');
            $table->float('rating')->nullable();
            $table->text('note')->nullable();

            $table->softDeletes();

            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};