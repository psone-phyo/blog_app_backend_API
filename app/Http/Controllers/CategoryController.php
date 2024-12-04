<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function index(){
        $data = Category::whereany(['title', 'description', 'category_id'], 'like', '%'.request('searchKey').'%')->get();
        return view('admin.category.index', compact('data'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        Category::create([
            'title' => $request->title,
            'description' => $request->description
        ]);
        Alert::alert('Category Created', 'Category is successfully created', 'success');
        return back();
    }

    public function updateForm($id){
        $data = Category::where('category_id', $id)->first();
        return view('admin.category.update', compact('data'));
    }

    public function update($id, Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        Category::where('category_id', $id)->update([
            'title' => $request->title,
            'description' => $request->description
        ]);
        Alert::alert('Category Updated', 'Category is successfully updated', 'success');
        return redirect()->route('category');
    }

    public function delete($id){
        Category::where('category_id', $id)->delete();
        Alert::alert('Category Deleted', 'Category is successfully Delete', 'success');
        return back();
    }
}
