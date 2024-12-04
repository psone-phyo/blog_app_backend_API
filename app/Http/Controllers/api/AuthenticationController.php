<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
    try {
        $validation = Validator::make($request->all(), [
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ]);

        if ($validation->fails()) {
            $errors = collect($validation->errors()->toArray())
            ->map(function ($error) {
                return $error[0];
            });
        return response()->json([
            'error' => $errors,
            'status' => 422
        ]);
        }

        $user = User::where('email', $request->email)->first();
        if (Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $user->createToken(time())->plainTextToken,
                'status' => 200
            ],200);
        } else {
            return response()->json([
                'error' => 'Incorrect password',
                'status' => 401
            ]   );
        }
    } catch (Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'status' => 500
        ],500);
    }
    }

    public function register(Request $request)
    {
    try {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|max:15'
        ]);

        if ($validation->fails()) {
            $errors = collect($validation->errors()->toArray())
            ->map(function ($error) {
                return $error[0];
            });
        return response()->json([
            'error' => $errors,
            'status' => 422
        ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'Sign up successful',
            'user' => $user,
            'token' => $user->createToken(time())->plainTextToken,
            'status' => 201
        ],201);

    } catch (Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'status' => 500
        ], 500);
    }
    }
}
