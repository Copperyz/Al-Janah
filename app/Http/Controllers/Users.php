<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Users extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $roles = Role::all();

    return view('users.index')->with('roles', $roles);
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
    $validator = Validator::make($request->all(), [
      'name' => ['required', 'string', 'min:2', 'max:30'],
      'email' => ['required', 'email', Rule::unique(User::class)],
      'password' => ['required', 'string', 'min:6', 'max:30'],
      'role' => ['required'],
    ]);
     if ($validator->fails()) {
        return response()->json([
            'message' => __('The given data was invalid'),
            'errors' => $validator->errors()
        ], 422);
      }

    DB::beginTransaction();
    try {
      // Hash the password
      $request['password'] = Hash::make($request['password']);

      $user = User::create($request->all());

      $user->assignRole($request->role);
      
      event(new Registered($user));
      DB::commit();
      // Redirect or return a response as needed
      return response()->json(['message' => __('User added successfully')], 200);
    } catch (\Exception $e) {
      // Rollback the transaction in case of any errors
      DB::rollback();
      // Handle the error or redirect back with an error message
       return response()->json(['message' => __('Something went wrong').$e], 422);
    }
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
    try {
          $user = User::findOrFail($id);
          $validator = Validator::make($request->all(), [
              'name'     => 'required|string|min:3|max:30',
              'email'    => [
                  'nullable',
                  'email',
                  Rule::unique('users', 'email')->ignore($user->id, 'id'),
              ],
              'password' => 'nullable|string|min:6|max:30',
          ]);
          if ($validator->fails()) {
              return response()->json([
                  'message' => __('The given data was invalid'),
                  'errors' => $validator->errors()
              ], 422);
          }
          $user->name = $request->filled('name') ? $request->name : $user->name;
          $user->email = $request->filled('email') ? $request->email : $user->email;
          $user->password = $request->filled('password') ? Hash::make($request->password) : $user->password;
          $user->save();
          
          $user->syncRoles($request->filled('role') ? $request->role : '');

          return response()->json(['message' => __('User updated successfully')], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => __('The given data was invalid'),
                'errors' => [__('User not found')]
            ], 404);
        }

  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $user = User::findOrFail($id);
    $user->delete();
    return response()->json(['message' => __('User deleted successfully')]);
        // if ($user->block == 0) {
        //     $user->block = 1;
        //     $user->save();
        //     return response()->json(['message' => __('User blocked successfully')]);
        // }
        // else {
        //     $user->block = 0;
        //     $user->save();
        //     return response()->json(['message' => __('User unblocked successfully')]);
        // }
  }

  public function get_users()
  {
    $query = User::with('roles:id,name')
    ->where('id', '!=', 1)
    ->select('id', 'name', 'email')
    ->orderBy('id', 'DESC');

    // Use the DataTables library to handle server-side processing
    return Datatables::eloquent($query)
        ->addColumn('userPermissions', function ($user) {
            return $user->getDirectPermissions()->pluck('name')->toArray();
        })
        ->addColumn('userRoles', function ($user) {
            return $user->getRoleNames()->toArray();
        })
        ->addColumn('options', function ($user) {
            $options = '';

            // Check if the authenticated user has permission to edit the user
            if (auth()->user()->can('edit user')) {
                $options .= '<a href="javascript:;" class="text-body editUser" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEditUser">' .
                    '<i class="ti ti-edit ti-sm me-2"></i></a>';
            }

            // Check if the authenticated user has permission to delete the user
            if (auth()->user()->can('delete user')) {
                $options .= '<a href="javascript:;" class="text-body delete-record"><i class="ti ti-trash ti-sm mx-2"></i></a>';
            }

            return $options;
        })
        ->rawColumns(['options'])
        ->make(true);

  }
  
}