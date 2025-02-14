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
        Schema::table('referrals', function (Blueprint $table) {
            // Adding the status_id foreign key column
            $table->foreignId('status_id')->nullable()->constrained('statuses')->onDelete('set null');

            // Dropping the old status column
            $table->dropColumn('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('referrals', function (Blueprint $table) {
            // Adding back the old status column as enum
            $table->enum('status', ['pending', 'accepted', 'rejected', 'completed'])->default('pending');

            // Dropping the status_id column
            $table->dropColumn('status_id');
        });
    }
};
