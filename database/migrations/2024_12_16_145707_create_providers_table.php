<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('name'); // Name field for storing the full name (dynamically set in the model)
            $table->string('gender'); // Gender of the provider
            $table->date('dob'); // Date of birth
            $table->string('contact_number');
            $table->string('email');
            $table->string('specialization')->nullable(); // Specialization
            $table->string('license_number')->nullable(); // License number
            $table->string('clinic_name')->nullable(); // Clinic name
            $table->string('street_address');
            $table->string('city');
            $table->string('state');
            $table->string('postal_code');
            $table->string('country')->nullable();  // Country of the provider
            $table->string('address'); // Address field for storing the full address (dynamically set in the model)
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->json('work_hours')->nullable(); // Work hours (days and times)
            $table->enum('account_status', ['Active', 'Suspended', 'Retired'])->default('Active'); // Account status
            $table->json('login_history')->nullable(); // Login history (for security purposes)
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('providers');
    }
}