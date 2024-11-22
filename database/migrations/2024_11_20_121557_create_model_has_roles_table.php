<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelHasRolesTable extends Migration
{
    public function up()
    {
        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->id();
            $table->morphs('model'); // Creates `model_type` and `model_id` for polymorphic relationships
            $table->foreignId('role_id')->constrained()->onDelete('cascade'); // Foreign key to `roles` table
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('model_has_roles');
    }
}
