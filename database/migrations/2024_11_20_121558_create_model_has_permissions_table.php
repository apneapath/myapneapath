<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelHasPermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->id();
            $table->morphs('model'); // Creates `model_type` and `model_id` for polymorphic relationships
            $table->foreignId('permission_id')->constrained()->onDelete('cascade'); // Foreign key to `permissions` table
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('model_has_permissions');
    }
}
