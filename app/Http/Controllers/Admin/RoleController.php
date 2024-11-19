<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    // Display list of roles
    public function index()
    {
        $roles = Role::all();  // Get all roles
        return view('backoffice.admin.roles-list', compact('roles'));
    }

    public function create()
    {
        // Get all permissions to display in the select dropdown
        $permissions = Permission::all();
        return view('backoffice.admin.add-role', compact('permissions'));
    }

    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array', // Permissions are optional but must be an array if provided
        ]);

        // Create the new role
        $role = Role::create(['name' => $request->name]);

        // Assign selected permissions to the role
        if ($request->permissions) {
            // Using sync() to add permissions, you can also use attach() if needed
            $role->permissions()->sync($request->permissions);
        }

        // Redirect back with success message
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }


}
