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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade'); // patient being referred
            $table->foreignId('referring_provider_id')->constrained('users'); // provider referring the patient
            $table->foreignId('referred_provider_id')->nullable()->constrained('users'); // provider being referred to
            $table->text('reason'); // reason for referral
            $table->string('urgency')->default('routine'); // referral urgency (urgent, routine)
            $table->enum('status', ['pending', 'accepted', 'rejected', 'completed'])->default('pending'); // referral status
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
