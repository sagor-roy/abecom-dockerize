<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        return view('backend.pages.roles.manage');
    }

    //data
    public function data()
    {
        $role = Role::orderBy('id', 'desc')->get();

        return DataTables::of($role)
        ->rawColumns(['action', 'status', 'menu'])
        ->editColumn('menu', function (Role $role) {
            $data = '';
            foreach ($role->menu as $role_menu) {
                $data .= $role_menu->name.',';
            }

            return $data;
        })
        ->editColumn('status', function (Role $role) {
            if ($role->is_active == true) {
                return '<p class="badge badge-success">Active</p>';
            } else {
                return '<p class="badge badge-danger">Inactive</p>';
            }
        })
        ->addColumn('action', function (Role $role) {
            return '
            <button type="button" data-content="'.route('role.edit', $role->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
                    Edit
            </button>
            ';
        })
        ->make(true);
    }

    //add
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required|unique:roles,role,',
            'menus.*' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            try {
                $role = new Role();
                $role->role = $request->role;
                $role->is_active = true;
                if ($role->save()) {
                    foreach ($request['menus'] as $menu) {
                        $role->menu()->attach($menu);
                    }

                    return response()->json(['create' => 'Created'], 200);
                }
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }

    //edit
    public function edit($id)
    {
        $role = Role::find($id);

        return view('backend.pages.roles.modals.edit', compact('role'));
    }

    //update
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required|unique:roles,role,'.$id,
            'menus.*' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            try {
                $role = Role::find($id);
                $role->role = $request->role;
                $role->is_active = $request->is_active;
                if ($role->save()) {
                    $role->menu()->detach();
                    foreach ($request['menus'] as $menu) {
                        $role->menu()->attach($menu);
                    }

                    return response()->json(['update' => 'Updated'], 200);
                }
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
}
