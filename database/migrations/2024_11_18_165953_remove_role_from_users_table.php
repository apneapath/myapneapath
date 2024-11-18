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
        // Dropping the role column from the users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Optionally, add the role column back in case of rollback
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->nullable();  // Adjust the column type based on your use case
        });
    }
};
