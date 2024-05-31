<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show(int $id)
    {
        try {
            $order = Order::with('products')->findOrFail($id);
            return response()->json([
                'order' => $order,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Order not found',
            ], 404);
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
