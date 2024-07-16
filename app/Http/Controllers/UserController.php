<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function users()
    {
        $users = User::all();
        return view('user.view_user', compact('users'));
    }
    public function userCreate()
    {
        return view('user.create_user');
    }

    public function userInsert(Request $request)
    {
        $validateRequest = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'mobile_no' => 'required',
            'password' => 'required',
        ]);
        $user = User::create([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'address'  => $request->input('address'),
            'mobile_no'   => $request->input('mobile_no'),
            'password' => Hash::make($request->password),
        ]);

        session()->flash('success', 'User added successfully!');
        return redirect()->route('userinfo');
    }

    public function userEdit($id)
    {
        $user = User::find($id);
        return view('user.create_user', compact('user'));
    }

    public function userUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'mobile_no' => 'required',
        ]);

        $users = User::find($id);
        $users->update([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'address'  => $request->input('address'),
            'mobile_no'   => $request->input('mobile_no'),
            'password' => Hash::make($request->password),
        ]);

        session()->flash('success', 'User Update successfully!');
        return redirect()->route('userinfo');
    }

    public function userDestroy($id)
    {
        $user = User::find($id);
        $user->delete();
        session()->flash('danger', 'User Delete successfully!');    
        return redirect()->back();
    }

    // public function myProfile()
    // {
    //     if (Auth::check()) {
    //         $userid = Auth::user()->id;
    //         $users = User::with('role')->find($userid);
    //     }
    //     $roles = Role::pluck('role_name', 'id');
    //     return view('admin.user_profile', compact('users', 'roles'));
    // }

    // public function editProfile($id)
    // {
    //     if (Auth::check()) {
    //         $users = User::find($id);
    //     }
    //     return view('admin.user_profile', compact('users'));
    // }

    public function Profileupdate(Request $request, $id)
    {

        $validateRequest = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'mobile_no' => 'required',
        ]);

        if ($validateRequest->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validateRequest->errors()
            ], 403);
        }

        $users = User::find($id);

        $users->update([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'address'   => $request->input('address'),
            'mobile_no'  => $request->input('mobile_no'),
        ]);

        return redirect()->route('myprofile')->with('success', 'Profile updated successfully');
        
    }
    
}
