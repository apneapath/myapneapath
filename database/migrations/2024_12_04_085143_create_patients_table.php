<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // First Name
            $table->string('last_name');  // Last Name
            $table->enum('gender', ['Male', 'Female', 'Non-binary', 'Other']); // Gender
            $table->date('dob');  // Date of Birth
            $table->string('contact_number'); // Contact number
            $table->string('email')->nullable(); // Email (optional)
            $table->text('medical_history')->nullable(); // Medical History (optional)
            $table->text('allergies')->nullable(); // Allergies (optional)
            $table->string('insurance_provider')->nullable(); // Insurance Provider (optional)
            $table->string('policy_number')->nullable(); // Insurance Policy Number (optional)
            $table->string('street_address'); // Street Address
            $table->string('city'); // City
            $table->string('state'); // State
            $table->string('postal_code'); // Postal Code
            $table->string('country'); // Country
            $table->string('name'); // Full Name (First Name + Last Name)
            $table->string('address'); // Full Address (Street Address + City + State + Postal Code + Country)
            $table->string('emergency_contact_name')->nullable(); // Emergency Contact Name (optional)
            $table->string('emergency_contact_phone')->nullable(); // Emergency Contact Phone (optional)
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
