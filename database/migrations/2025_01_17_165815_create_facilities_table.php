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
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('facility_name'); // A column to store the name of the facility
            $table->timestamps(); // For storing created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('facilities');
    }
};
