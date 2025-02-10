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
            $table->foreignId('order_type_id')->constrained('order_types')->onDelete('cascade'); // Assuming 'order_types' table exists
        });
    }

    public function down()
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->dropForeign(['order_type_id']); // Drop foreign key constraint
            $table->dropColumn('order_type_id'); // Remove the column
        });
    }

};
