<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Orders::all();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $order = Orders::create($request->all());
        return response()->json($order, 201);
    }

    public function show($id)
    {
        $order = Orders::findOrFail($id);
        return response()->json($order);
    }

    public function update(Request $request, $id)
    {
        $order = Orders::findOrFail($id);
        $order->update($request->all());
        return response()->json($order, 200);
    }

    public function destroy($id)
    {
        $order = Orders::findOrFail($id);
        $order->delete();
        return response()->json(null, 204);
    }
}