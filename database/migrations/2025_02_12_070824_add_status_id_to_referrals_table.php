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
            // Check if the column exists before adding it
            if (!Schema::hasColumn('referrals', 'status_id')) {
                // Add the status_id foreign key column
                $table->foreignId('status_id')->nullable()->constrained('statuses')->onDelete('set null');
            }

            // Drop the old status column
            $table->dropColumn('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('referrals', function (Blueprint $table) {
            // Add back the old status column
            $table->enum('status', ['pending', 'accepted', 'rejected', 'completed'])->default('pending');

            // Drop the status_id foreign key column
            $table->dropColumn('status_id');
        });
    }
};
