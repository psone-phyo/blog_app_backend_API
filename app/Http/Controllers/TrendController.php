<?php

namespace App\Http\Controllers;

use App\Models\ActionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrendController extends Controller
{
    public function index(){
        $data = ActionLog::select('posts.*', DB::raw('COUNT(action_logs.post_id) as view_count'))
                ->leftjoin('posts', 'posts.post_id', 'action_logs.post_id')
                ->groupBy('posts.post_id')
                ->orderBy('view_count', 'desc')
                ->get();
        return view('admin.trendingPosts.index', compact('data'));
    }

    public function details($id){
        $data = ActionLog::select('posts.*', DB::raw('COUNT(action_logs.post_id) as view_count'))
                ->leftjoin('posts', 'posts.post_id', 'action_logs.post_id')
                ->where('action_logs.post_id', $id)
                ->first();
        return view('admin.trendingPosts.details', compact('data'));
    }
}
