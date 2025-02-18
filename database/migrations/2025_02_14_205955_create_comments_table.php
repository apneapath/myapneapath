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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('content'); // The actual comment text
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User who wrote the comment
            $table->foreignId('referral_id')->constrained()->onDelete('cascade'); // Referral that the comment is associated with
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
