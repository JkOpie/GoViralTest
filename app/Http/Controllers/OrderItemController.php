<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $orderitem = OrderItem::create([
            "order_id" => $request->order_id,
            "cost_per_item" => $request->cost_per_item,
            "product_name" => $request->product_name,
            "quantity" => $request->quantity
        ]);

        return ["data" => $this->calc_total($request->order_id), "orderitem" => $orderitem];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $newSubTotal = 0;
        $orderitems = OrderItem::where('id', $id)->first();
        $orderitems->quantity = $request->quantity;
        $orderitems->save();

        return $this->calc_total($orderitems->order_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orderitem = OrderItem::where('id', $id)->first();
        $order_id = $orderitem->order_id;
        $orderitem->delete();
        $data = $this->calc_total($order_id);
        
        return $data;;
    }

    public function calc_total($orderitems){

        $subtotal = 0;
        $tax = 0.06;
        $number_of_items = 0;

        $orderItems = OrderItem::where('order_id', $orderitems)->get();

        foreach ($orderItems as $key => $orderItem) {
            $subtotal = $subtotal + ( $orderItem->cost_per_item * $orderItem->quantity );
            $number_of_items =  $number_of_items + $orderItem->quantity;
        }

        Order::where('id', $orderitems)->update([
            "total_amount_cents" => $subtotal * 100
        ]);

        return [
            "subtotal" => number_format($subtotal, 2),
            "tax" =>  $subtotal * $tax,
            "total" => $subtotal - ($subtotal * $tax), 
            "number_of_items" => $number_of_items 
        ];
    }
}
