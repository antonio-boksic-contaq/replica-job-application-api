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
        Schema::create('headquarters', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('country');//queste in teoria sarebbero chiavi esterne, ma le gestisco come campi normali per ora
            $table->string('city')->nullable();//queste in teoria sarebbero chiavi esterne, ma le gestisco come campi normali per ora
            $table->string('foreign_city')->nullable();
            $table->boolean('is_main')->default(false);

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('headquarters');
    }
};