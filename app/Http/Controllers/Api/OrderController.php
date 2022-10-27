<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use function Symfony\Component\HttpKernel\HttpCache\load;
use function Symfony\Component\Routing\Loader\Configurator\collection;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Order::query()->with('orderItem')->get();
        return OrderResource::collection($query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request, Order $order)
    {
        $order->status=$request->status;
        $order->comment=$request->comment;
        $order->address=$request->address;
        if ($request->has('products')) {
            $order->Products()->attach($order->id, ['price' => $request->price, 'quantity' => $request->quantity]);
        }
        $order->save();
        if ($order){
            return $order;
        }
        else{
            return response()->json('Update has been failed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return new OrderResource(($order)->load('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->status=$request->status;
        $order->comment=$request->comment;
        $order->address=$request->address;
        if ($request->has('products')) {
            $order->Products()->attach($order->id, ['price' => $request->price, 'quantity' => $request->quantity]);
        }
        $order->save();
        if ($order){
            return $order;
        }
        else{
            return response()->json('Update has been failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
