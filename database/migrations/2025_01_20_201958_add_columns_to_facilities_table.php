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
        Schema::table('facilities', function (Blueprint $table) {
            $table->string('address')->nullable();  // Add address column
            $table->string('phone_number')->nullable();  // Add phone number column
            $table->string('email')->nullable();  // Add email column
            $table->string('facility_type')->nullable();  // Add facility type column
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('facilities', function (Blueprint $table) {
            $table->dropColumn(['address', 'phone_number', 'email', 'facility_type']);
        });
    }

};
