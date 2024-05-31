<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{

    public function index()
    {
        try {
            $products = Product::all();
            return response()->json([
                'products' => $products,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Products not found',
            ], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:191|unique:products',
                'price' => 'required|decimal:0,2|between:0,999999.99',
            ]);

            $product = Product::create($request->all());

            return response()->json([
                'product' => $product,
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
            $product = Product::findOrFail($id);
            $productUsers = $product->orders()->with('user')->get();
            return response()->json([
                'productUsers' => $productUsers,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Product not found',
            ], 400);
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            $product = Product::findOrFail($id);
            $request->validate([
                'name' => 'required|string|max:191|unique:products,name,' . $product->id,
                'price' => 'required|decimal:0,2|between:0,999999.99',
            ]);
            $product->update($request->all());
            return response()->json([
                'message' => 'product updated',
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'error',
                'status' => 422,
                'data' => $e->validator->errors(),
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Product not found',
            ], 400);
        }
    }


    public function destroy(int $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json([
                'message' => 'Product deleted',
            ], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Product not found',
            ]);
        }
    }
}
