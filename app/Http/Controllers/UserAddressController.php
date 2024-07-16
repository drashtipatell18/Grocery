<?php

namespace App\Http\Controllers;
use App\Models\UserAddress;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    public function userAddress(){
        $useraddress = UserAddress::with('user')->get();
        return view('user.view_useraddress', compact('useraddress'));

    }
    public function userAddressCreate(){
        $users = User::pluck('name', 'id');
        return view('user.create_useraddress',compact('users'));
    }
    public function userAddressInsert(Request $request){
        $validateRequest = Validator::make($request->all(), [
            'address' => 'required',
        ]);

        $user = UserAddress::create([
            'user_id'      => $request->input('user_id'),
            'address'  => $request->input('address'),
        ]);

        session()->flash('success', 'User Address added successfully!');
        return redirect()->route('useraddress');
    }  
    public function userAddressEdit($id){
        $users = User::pluck('name','id');
        $useraddress = UserAddress::find($id);
        return view('user.create_useraddress', compact('users','useraddress'));
    }
    public function userAddressUpdate(Request $request, $id){
        $request->validate([
            'address' => 'required',
        ]);
        $useraddress = UserAddress::find($id);

        $useraddress->update([
            'user_id'      => $request->input('user_id'),
            'address'  => $request->input('address'),
        ]);

        session()->flash('success', 'User Address added successfully!');
        return redirect()->route('useraddress');
    }
    public function userAddressDestroy($id){
        $useraddress = UserAddress::find($id);
        $useraddress->delete();
        session()->flash('danger', 'User Address Delete successfully!');
        return redirect()->back();
    }
}
