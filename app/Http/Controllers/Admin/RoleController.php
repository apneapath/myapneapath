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

    public function edit($id)
    {
        // Find the role by ID
        $role = Role::findOrFail($id);

        // Get all available permissions
        $permissions = Permission::all();

        // Return the edit view with the role and permissions
        return view('backoffice.admin.edit-role', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'array',
        ]);

        // Find the role by ID
        $role = Role::findOrFail($id);

        // Update the role's name
        $role->name = $request->name;
        $role->save();

        // Sync the role's permissions
        if ($request->permissions) {
            // Use sync() to ensure the permissions are updated
            $role->permissions()->sync($request->permissions);
        }

        // Redirect back with a success message
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    // Delete a role
    public function destroy($id)
    {
        $role = Role::findOrFail($id);  // Find the role by ID or fail if not found

        // Optional: Add a check to ensure this role is not being used by any other entities, such as users.
        if ($role->users()->count() > 0) {
            return redirect()->route('roles.index')->with('error', 'This role cannot be deleted because it is assigned to one or more users.');
        }

        // Delete the role
        $role->delete();

        // Redirect back with success message
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }



}
