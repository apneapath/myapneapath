<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotesToReferralsTable extends Migration
{
    public function up()
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->text('notes')->nullable(); // Add the notes column (nullable in case not provided)
        });
    }

    public function down()
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->dropColumn('notes'); // Remove the notes column if the migration is rolled back
        });
    }
}
