<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Models\ActionLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ActionLogController extends Controller
{
    public function store(Request $request){
        try {
            logger($request->all());
            $validation = Validator::make($request->all(), [
                'user_id' => 'required',
                'post_id' => 'required',

            ]);

            if ($validation->fails()) {
                $errors = collect($validation->errors()->toArray())
                ->map(function ($error) {
                    return $error[0];
                });
            return response()->json([
                'error' => $errors,
                'status' => 422
            ], 200);
            }

            ActionLog::create([
                'user_id' => $request->user_id,
                'post_id' => $request->post_id,
            ]);
            $view = ActionLog::where('post_id', $request->post_id)->count();
            return response()->json([
                'view' => $view,
                'status' => 201
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
}
