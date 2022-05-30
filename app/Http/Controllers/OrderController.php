<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order_items = collect(); $calc_total = [];
        
        $orders = Order::orderBy('created_at', 'desc')->get();
        $first_order = Order::orderBy('created_at', 'desc')->first();

        if($first_order){
           
            $order_items = OrderItem::where('order_id', $first_order->id )->orderBy('created_at', 'desc')->get();
            $calc_total = $this->calc_total($first_order->id);
        }
        
       
        return view('welcome', compact('orders', 'order_items', 'first_order', 'calc_total'));
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
        $lastOrder = 0;
        $lastOrder = Order::orderBy('created_at','DESC')->first();

        if($lastOrder){
            $lastOrder = $lastOrder->id;
        }

        $order = Order::firstOrCreate([
            "reference_no" => str_pad( $lastOrder + 1, 8, "0", STR_PAD_LEFT),
            "tax" => 6,
            "service_charge" => 0,
            "total_amount_cents" => 0,
            "status" => 'pending'
        ]);

        Transaction::create([
            'order_id' => $order->id,
            'paid_amount_cents' => 0,
            'change_cents' => 0,
            'payment_method' => 'cash',
            "status" => 'pending'
        ]);

        return $order;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        $first_order = Order::where('id', $id)->first();
        $order_items = OrderItem::where('order_id', $first_order->id )->orderBy('created_at', 'desc')->get();
        $calc_total = $this->calc_total($first_order->id);
        
        return view('welcome', compact('orders', 'order_items', 'first_order', 'calc_total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        Order::where('id', $id)->with('order_item')->first();
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
        $order = '';

        if($request->status == "refunded"){

            $order = Order::where('id', $id)->first();
            $order->status = "cancelled";
            $order->save();
    
            Transaction::where('order_id', $id)->update([
                "status" => $request->status
            ]);

        }

        return $order;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Order::find($id)->delete();
    }

    public function calc_total($order_id){

        $subtotal = 0;
        $tax = 0.06;
        $number_of_items = 0;

        $orderItems = OrderItem::where('order_id', $order_id)->get();

        foreach ($orderItems as $key => $orderItem) {
            $subtotal = $subtotal + ( $orderItem->cost_per_item * $orderItem->quantity );
            $number_of_items =  $number_of_items + $orderItem->quantity;
        }

        Order::where('id', $order_id)->update([
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
