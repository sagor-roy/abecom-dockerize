<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('backend.pages.user.manage');
    }

    //data
    public function data()
    {
        $user = User::orderBy('id', 'desc')->where('is_admin', false)->where('id', '!=', auth('web')->user()->id)->get();

        return DataTables::of($user)
        ->rawColumns(['action', 'status', 'user', 'role'])
        ->editColumn('role', function (User $user) {
            $data = '';
            foreach ($user->role as $role) {
                $data .= $role->role.', ';
            }

            return $data;
        })
        ->editColumn('user', function (User $user) {
            return '
                <p>Name : '.$user->name.'</p>
                <p>Email : '.$user->email.'</p>
            ';
        })
        ->editColumn('status', function (User $user) {
            if ($user->is_active == true) {
                return '<p class="badge badge-success">Active</p>';
            } else {
                return '<p class="badge badge-danger">Inactive</p>';
            }
        })
        ->addColumn('action', function (User $user) {
            return '
            <button type="button" data-content="'.route('user.password', $user->id).'" data-target="#myModal" class="btn btn-success" data-toggle="modal">
                    Reset Password
            </button>
            <button type="button" data-content="'.route('user.edit', $user->id).'" data-target="#myModal" class="btn btn-primary" data-toggle="modal">
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
            'name' => 'required',
            'email' => 'required|unique:users,email,',
            'password' => 'required|confirmed',
            'roles.*' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            try {
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->is_admin = false;
                $user->is_active = true;
                if ($user->save()) {
                    foreach ($request['roles'] as $role) {
                        $user->role()->attach($role);
                    }

                    return response()->json(['create' => 'New User Created'], 200);
                }
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }

    //edit
    public function edit($id)
    {
        $user = User::find($id);

        return view('backend.pages.user.modals.edit', compact('user'));
    }

    //update
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'roles.*' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            try {
                $user = User::find($id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->is_active = $request->is_active;
                if ($user->save()) {
                    $user->role()->detach();
                    foreach ($request['roles'] as $role) {
                        $user->role()->attach($role);
                    }

                    return response()->json(['update' => 'User updated'], 200);
                }
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
    
    //password modal
    public function password($id){
        $user = User::find($id);

        return view('backend.pages.user.modals.reset', compact('user'));
    }
    
    public function reset(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }else{
            try{
                $user = User::find($id);
                $user->password = Hash::make($request->password);
                if( $user->save() ){
                    return response()->json(['update'=>'Updated'], 200);
                }
            }
            catch(Exception $e){
                 return response()->json(['error' => $e->getMessage()], 500);
            }
        }
        

    }
}
