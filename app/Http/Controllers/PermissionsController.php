<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('permissions.index');
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
        $request->validate([
            'name' => 'required|string|unique:permissions',
        ]);

        $permission = Permission::create([
            'name' => $request->input('name'),
        ]);

        return response()->json(['message' => __('Permission created successfully')], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        // Validate the request data
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('permissions', 'name')->ignore($id),
            ],
        ]);

        // Find the permission by ID
        $permission = Permission::findOrFail($id);

        // Update the permission attributes
        $permission->name = $request->input('name');
        // Add other attributes to update as needed

        // Save the changes
        $permission->save();

        // Optionally, you can return a response or redirect to a different page
        return response()->json(['message' => __('Permission updated successfully')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);

        if ($permission) {
            $permission->delete();

            return response()->json(['message' => __('Permission deleted successfully')]);
        }

        return response()->json(['message' => __('Permission not found')], 404);
    }

    public function get_permissions()
  {
    $permissions = Permission::orderBy('id', 'DESC')->get();
    $permissions->each(function ($permission) {
    $carbonDate = Carbon::parse($permission->created_at);
    $permission->setAttribute('carbonDate', $carbonDate->format('Y-m-d g:i A'));
    });

    return Datatables::of($permissions)
      ->rawColumns(['Options'])
      ->make(true);
  }
}