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
            $table->renameColumn('reason', 'status_reason');
        });
    }

    public function down()
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->renameColumn('status_reason', 'reason');
        });
    }

};
