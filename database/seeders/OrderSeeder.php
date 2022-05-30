<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            "Dutch Lady",
            "Farm Fresh",
            "Almond Milk",
            "Goodday Milk"
        ];
        DB::table('order_items')->truncate();
      
        for ($i=0; $i < 3; $i++) { 

            //create Order
            $lastOrder = Order::orderBy('created_at','DESC')->first();

            if($lastOrder){
                $lastOrder = $lastOrder->id;
            }else{
                $lastOrder = 0;
            }

            $order = Order::firstOrCreate([
                "reference_no" => str_pad( $lastOrder + 1, 8, "0", STR_PAD_LEFT),
                "tax" => 6,
                "service_charge" => 0,
                "total_amount_cents" => 0,
                "status" => 'pending'
            ]);

            Transaction::firstOrCreate([
                "order_id" => $order->id,
                "status" => "pending"
            ]);

            foreach ($products as $key => $product) {
                //Create Order Item
                $orderItem = OrderItem::firstOrCreate([
                    "order_id" => $order->id,
                    "cost_per_item" => 2,
                    "product_name" => $product,
                    "quantity" => rand(2,10)
                ]);

                $order->total_amount_cents = $order->total_amount_cents + ($orderItem->cost_per_item * $orderItem->quantity) * 100;
                $order->save();
    
            }
        }

       

      

       
    }
}
