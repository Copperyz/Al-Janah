<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(5);
        $permissions = Permission::all();

        return view('roles.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        // Create the role
        $role = Role::create([
            'name' => $request->input('name'),
        ]);

        // Sync permissions with the role
        $permissions = collect($request->input('permission', []))->filter(); // Filter out unchecked checkboxes
        $role->syncPermissions($permissions->keys());
        

        // Return a response as needed
        return response()->json(['message' => __('Role created successfully')], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get role details including permissions
        $role = Role::with('permissions')->find($id);

        if (!$role) {
            return response()->json(['error' => 'Role not found'], 404);
        }

        return response()->json(['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request;

        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'permissions' => 'array', // Ensure permissions is an array
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Find the role by ID
        $role = Role::findOrFail($id);

        // Update the role name
        $role->update(['name' => $request->input('name')]);

        // Sync permissions with the role
        $permissions = collect($request->input('permission', []))->filter(); // Filter out unchecked checkboxes
        $role->syncPermissions($permissions->keys());
        

        return response()->json(['message' => __('Role updated successfully')], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}