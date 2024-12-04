<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function index(){
        $data = User::find(Auth::user()->id);
        return view('admin.profile.index',compact('data'));
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,

        ]);
        $data = $this->format($request);
        User::where('id', Auth::user()->id)->update($data);
        Alert::alert('Profile Update', 'Successfully updated the profile data', 'success');
        return back();
    }

    public function changepasswordForm (){
        return view('admin.profile.changepassword');
    }

    public function changepassword(Request $request){
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required|min:8|max:12',
            'newpassword_confirmation' => 'same:newpassword'
        ]);

        if (Hash::check($request->oldpassword, Auth::user()->password)){
            User::find(Auth::user()->id)->update([
                'password' => Hash::make($request->newpassword)
            ]);
            Alert::alert('Password Change', 'New password is Successfully updated', 'success');
            return redirect()->route('profile');
        }else{
            return back()->with('wrongpassword', 'Incorrect old password');
        }


    }

    private function format($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender ?? Auth::user()->gender
        ];
    }
}
