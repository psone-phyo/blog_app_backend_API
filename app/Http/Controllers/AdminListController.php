<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminListController extends Controller
{
    public function index(){
        $data = User::whereany(['name','email','phone','address','gender', 'id'], 'like', '%'.request('searchKey').'%')
                    ->get();
        return view('admin.adminlist.index', compact('data'));
    }

    public function delete($id){
        User::find($id)->delete();
        Alert::alert('Admin Deleted', 'The admin is successfully deleted', 'success');
        return back();
    }
}
