<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function index()
    {
        try {
            $users = User::all();
            return response()->json([
                'users' => $users,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Users not found',
            ], 404);
        }
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|string|email|unique:users',
            ]);

            $user = User::create($request->all());

            return response()->json([
                'user' => $user,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'error',
                'status' => 422,
                'data' => $e->validator->errors(),
            ], 422);
        }
    }


    public function show(int $id)
    {
        try {
            $user = User::findOrFail($id);
            $userProducts = $user->orders()->with('products')->get();
            return response()->json([
                'userProducts' => $userProducts,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User not found',
            ], 400);
        }
    }

    public function update(Request $request, int $id)
    {
        //
    }

    public function destroy(int $id)
    {
        //
    }
}
