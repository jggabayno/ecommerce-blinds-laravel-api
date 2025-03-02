<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Models\OrderStatus;

class OrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTime = Carbon::now();
 
        $order_statuses = [
            [
                'name' => 'Order Submitted',
                'description' => 'Your order has been submitted and is awaiting confirmation from staff',
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'name' => 'Order Placed',
                'description' => 'Your order has been placed',
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'name' => 'Processing',
                'description' => 'We received your payment, but the order is not yet shipped',
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'name' => 'For Delivery',
                'description' => 'Your order is on the way',
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'name' => 'Delivered',
                'description' => 'Your order has been successfully delivered',
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'name' => 'Completed',
                'description' => 'Your order has been completed',
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
            [
                'name' => 'Cancelled',
                'description' => 'Order has been cancelled',
                'created_at' => $currentTime->toDateTimeString(),
                'updated_at' => $currentTime->toDateTimeString()
            ],
        ];

        
        foreach($order_statuses as $order_status) {
            OrderStatus::create([
                'name' => $order_status['name'],
                'description' => $order_status['description'],
                'created_at' => $order_status['created_at'],
                'updated_at' => $order_status['updated_at']
            ]);
        }
    }
}














        // $order_statuses = [
        //     [
        //         'name' => 'Pending Payment',
        //         'description' => 'Orders awaiting payment from the customer',
        //         'created_at' => $currentTime->toDateTimeString(),
        //         'updated_at' => $currentTime->toDateTimeString()
        //     ],
            
        //     [
        //         'name' => 'Processing',
        //         'description' => 'Orders for which payment has been receive, but the order is not yet shipped',
        //         'created_at' => $currentTime->toDateTimeString(),
        //         'updated_at' => $currentTime->toDateTimeString()
        //     ],
        //     [
        //         'name' => 'Shipped',
        //         'description' => 'Orders that have been paid for and are on the way to customer',
        //         'created_at' => $currentTime->toDateTimeString(),
        //         'updated_at' => $currentTime->toDateTimeString()
        //     ],
        //     [
        //         'name' => 'On Hold',
        //         'description' => 'A process to fulfill the order has been paused',
        //         'created_at' => $currentTime->toDateTimeString(),
        //         'updated_at' => $currentTime->toDateTimeString()
        //     ],
        //     [
        //         'name' => 'Completed',
        //         'description' => 'Order has been shipped to the customer',
        //         'created_at' => $currentTime->toDateTimeString(),
        //         'updated_at' => $currentTime->toDateTimeString()
        //     ],
        //     [
        //         'name' => 'Cancelled',
        //         'description' => 'Order has been manually cancelled',
        //         'created_at' => $currentTime->toDateTimeString(),
        //         'updated_at' => $currentTime->toDateTimeString()
        //     ],
        // ];