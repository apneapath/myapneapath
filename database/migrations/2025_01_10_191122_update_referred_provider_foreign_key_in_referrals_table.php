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
        // Drop the old foreign key that references the users table
        Schema::table('referrals', function (Blueprint $table) {
            $table->dropForeign(['referred_provider_id']);
        });

        // Add the new foreign key referencing the providers table
        Schema::table('referrals', function (Blueprint $table) {
            $table->foreign('referred_provider_id')->references('id')->on('providers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the new foreign key
        Schema::table('referrals', function (Blueprint $table) {
            $table->dropForeign(['referred_provider_id']);
        });

        // Restore the old foreign key referencing the users table
        Schema::table('referrals', function (Blueprint $table) {
            $table->foreign('referred_provider_id')->references('id')->on('users')->onDelete('set null');
        });
    }
};
