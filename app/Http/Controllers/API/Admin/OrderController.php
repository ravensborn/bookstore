<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\ListOrdersRequest;
use App\Http\Requests\Orders\StoreOrderRequest;
use App\Http\Requests\Orders\UpdateOrderRequest;
use App\Http\Resources\Orders\OrderCollection;
use App\Http\Resources\Orders\OrderResource;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(ListOrdersRequest $request)
    {
        $orders = Order::when($request->search, function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->search . '%')
                ->orWhere('customer_name', 'like', '%' . $request->search . '%')
                ->orWhere('customer_phone_number', 'like', '%' . $request->search . '%');
        })->paginate(20);

        return response()->json(new OrderCollection($orders));
    }

    public function store(StoreOrderRequest $request)
    {
        $validated = $request->validated();

        $validated['status'] = Order::ORDER_STATUS_PENDING;

        $order = new Order($validated);
        $order->save();

        return response()->json(new OrderResource($order));
    }


    public function update(UpdateOrderRequest $request, Order $order)
    {
        $validated = $request->validated();

        $order->update($validated);

        return response()->json(new OrderResource($order));
    }

    public function show(Order $order)
    {
        return response()->json(new OrderResource($order));
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
            'message' => 'Order has been deleted.'
        ]);
    }
}
