<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Users extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('users.index');
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
    //
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
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }

  public function get_users()
  {
    $users = User::orderBy('id', 'DESC')->get();
    return Datatables::of($users)
      ->addColumn('Options', function ($row) {
        $deleteButton =
          '<a class="deleteButton" type="button" id="deleteButton" style="font-size: 25px; color: #dc3545"><i class="ri-delete-bin-line"></i></a>';
        if ($row->block == 1) {
          $deleteButton =
            '<a class="deleteButton" type="button" id="deleteButton" style="font-size: 25px; color: green"><i class="ri-check-line"></i></a>';
        }
        $editButton =
          '<a class="ml-2 mr-2 editUser" type="button" data-toggle="modal" data-target=".editModal" style="font-size: 25px; color: rgb(7, 159, 247)"><i class="las la-user-edit"></i></a>';
        return $editButton . $deleteButton;
      })
      ->rawColumns(['Options'])
      ->make(true);
  }
}
