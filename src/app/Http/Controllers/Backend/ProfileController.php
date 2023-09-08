<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index($email)
    {
        $user = User::where('email', $email)->first();

        return view('backend.pages.profile.manage');
    }

    public function edit_profile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($user->save()) {
                $url = route('profile.show', $id);

                return response()->json(['profile_update' => $url], 200);
            }
        }
    }

    public function change_password(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $user = User::find($id);
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->password);
                if ($user->save()) {
                    $url = route('profile.show', $id);

                    return response()->json(['profile_update' => $url], 200);
                }
            } else {
                return response()->json(['password_not_match' => 'Password did not match'], 200);
            }
        }
    }
}
