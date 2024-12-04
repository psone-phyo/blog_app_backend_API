<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Monolog\Handler\DeduplicationHandler;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    public function index(){
        $data = Post::select('posts.post_id', 'posts.title', 'posts.description', 'categories.title as name', 'posts.image')->whereany(['posts.post_id', 'posts.title', 'posts.description', 'categories.title', 'posts.image'], 'like', '%'.request('searchKey').'%')
                ->leftjoin('categories', 'posts.category_id', 'categories.category_id')
                ->get();
        $categories = Category::select('category_id', 'title')->get();
        return view('admin.posts.index', compact('data', 'categories'));
    }

    public function editForm($id){
        $data = Post::select('post_id', 'title', 'description', 'image', 'category_id')
                ->where('post_id', $id)
                ->first();
        // dd($data->toArray());
        $categories = Category::select('category_id', 'title')->get();
        return view('admin.posts.editForm', compact('data', 'categories'));
    }

    public function create(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:png,jpg,jpeg,avif,webp|max:2000',
            'category' => 'required'
        ]);
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category
        ];
        if ($request->file('image')){
            $file = $request->file('image');
            $filename = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/postimage', $filename);
            $data['image'] = $filename;

        }

        Post::create($data);
        Alert::alert('Post Created', 'The post is successfully created', 'success');
        return back();
    }

    public function edit($id, Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:png,jpg,jpeg,avif,webp|max:2000',
            'category' => 'required'
        ]);
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category
        ];

        if ($request->file('image')){
            $imageData = Post::select('image')->where('post_id', $id)->first();
            if ($imageData->image != null){
                if (file_exists(public_path()."/postimage/".$imageData->image)){
                    unlink(public_path()."/postimage/".$imageData->image);
                }
            }

            $file = $request->file('image');
            $filename = uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/postimage', $filename);
            $data['image'] = $filename;
        }
        Post::where('post_id', $id)->update($data);

        Alert::alert('Post Updated', 'The post is successfully updated', 'success');
        return redirect()->route('post');
    }

    public function delete($id){
        $data = Post::select('image')->where('post_id', $id)->first();
        Post::where('post_id', $id)->delete();

        if($data->image != null){
            if (file_exists(public_path()."/postimage/".$data->image)){
                unlink(public_path()."/postimage/".$data->image);
            }
        }

        Alert::alert('Post Delete', 'The post is successfully deleted', 'success');
        return back();
    }
}
