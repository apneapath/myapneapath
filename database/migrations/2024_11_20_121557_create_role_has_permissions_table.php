<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleHasPermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained()->onDelete('cascade'); // Foreign key to `roles` table
            $table->foreignId('permission_id')->constrained()->onDelete('cascade'); // Foreign key to `permissions` table
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_has_permissions');
    }
}
