<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $administrator = Role::create(['name' => 'Administrator']);
        $virtualAssistant = Role::create(['name' => 'Virtual Assistant']);

        // Define permissions
        $createPosts = Permission::create(['name' => 'create posts']);
        $editPosts = Permission::create(['name' => 'edit posts']);
        $deletePosts = Permission::create(['name' => 'delete posts']);
        $viewPosts = Permission::create(['name' => 'view posts']);

        // Assign permissions to roles
        $superAdmin->permissions()->attach([$createPosts->id, $editPosts->id, $deletePosts->id, $viewPosts->id]);
        $administrator->permissions()->attach([$createPosts->id, $editPosts->id, $viewPosts->id]);
        $virtualAssistant->permissions()->attach([$viewPosts->id]);
    }
}

