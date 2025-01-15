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
        Schema::table('providers', function (Blueprint $table) {
            // Adding NPI and Fax Number columns
            $table->string('npi', 10)->unique()->after('email');  // Add NPI after email (or any other position you prefer)
            $table->string('fax_number', 10)->nullable()->after('contact_number');  // Add fax number after contact number
        });
    }

    public function down()
    {
        Schema::table('providers', function (Blueprint $table) {
            // Drop the columns if rollback is required
            $table->dropColumn('npi');
            $table->dropColumn('fax_number');
        });
    }
};
