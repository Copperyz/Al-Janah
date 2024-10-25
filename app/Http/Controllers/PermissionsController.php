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
        // Start building the query and order by ID in descending order
        $query = Permission::orderBy('id', 'DESC');
    
        // Fetch the permissions from the database
        $permissions = $query->get();
        
        // Format the created_at date using Carbon for each permission
        $permissions->each(function ($permission) {
            $carbonDate = Carbon::parse($permission->created_at);
            $permission->setAttribute('carbonDate', $carbonDate->format('Y-m-d g:i A'));
        });
        
        // Create DataTable response
        return Datatables::of($permissions)
            ->addColumn('options', function ($permission) {
                $options = '<span class="text-nowrap">';
                
                // Check if the user has permission to edit
                if (auth()->user()->can('edit permission')) {
                    $options .= '<button class="btn btn-sm btn-icon me-2 editPermission" 
                                    data-bs-target="#editPermissionModal" 
                                    data-bs-toggle="modal">
                                    <i class="ti ti-edit"></i>
                                </button>';
                }
                
                // Check if the user has permission to delete
                if (auth()->user()->can('delete permission')) {
                    $options .= '<button class="btn btn-sm btn-icon delete-record">
                                    <i class="ti ti-trash"></i>
                                </button>';
                }
                
                $options .= '</span>';
                
                return $options;
            })
            ->rawColumns(['options'])
            ->make(true);
    }
    
    
    
}