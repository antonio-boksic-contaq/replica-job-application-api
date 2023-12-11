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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['email','email_verified_at','remember_token','password']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('telephone')->nullable();
            $table->foreignId('candidate_id')->nullable()->references('id')->on('candidates');
            $table->string('password')->nullable();
            $table->enum('gender', ['M','F','N']);
            $table->string('employee_code')->nullable();
            $table->string('fiscal_code')->nullable();
            $table->string('iban')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('residence_address')->nullable();
            /* 
            QUESTE NON LE METTO PER SEMPLIFICARE UN PO IL GIRO 
            E PERCHè HO GESTITO LE CITTà/PAESI IN MANIERA DIVERSA RISPETTO A QUELLO CHE RICHIEDE QUESTA TABELLA

            $table->string('residence_zipcode')->nullable();
            $table->foreignId('residence_country_id')->nullable()->references('id')->on('geo_countries');
            $table->foreignId('residence_city_id')->nullable()->references('id')->on('geo_cities');
            $table->string('residence_foreign_city')->nullable();
            $table->foreignId('birth_city_id')->nullable()->references('id')->on('geo_cities');
            $table->string('birth_foreign_city')->nullable();
            $table->foreignId('birth_country_id')->nullable()->references('id')->on('geo_countries');
            */
            $table->softDeletes();    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};