<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\ProductColor;
use App\Models\OrderItem;
use App\Models\PaymentDetail;
use App\Models\Product;
use App\Helpers\Constant;

use DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

    $year = $request->year;

    $total_orders = Order::withDateFilter($request)->get()->count();

    $top_selling_products = OrderItem::select(
        'product_name',
        'color_name',
        DB::raw('SUM(quantity) as qty_sold'))
    ->groupBy('product_name', 'color_name')
    ->orderBy('qty_sold', 'DESC')
    ->take(3)
    ->get();

    $total_sales = OrderItem::getSalesCountWithRangeFilter($request);
    $total_revenu = OrderItem::getRevenuCountWithRangeFilter($request);
    $total_products = ProductColor::withDateFilter($request)->get()->count();
    $totalConsumer = User::withDateFilter($request)->where('user_type_id', Constant::USER_TYPE['CUSTOMER'])->count();
    $user_with_order = Order::select(['user_id'])->get();
    $unique_user_with_order = $user_with_order->merge($user_with_order)->unique()->count();
 
    $consumer_with_order = [
        'percentage' => ($totalConsumer === 0 ? 0 : ($unique_user_with_order / $totalConsumer)) * 100,
        'description' =>   $unique_user_with_order.' out of '. $totalConsumer.' Total Consumer'
    ];

    return [
        'consumer_with_order' =>  $consumer_with_order,
        'total_orders' => $total_orders,
        'total_sales' => $total_sales,
        'total_revenue' => $total_revenu,
        'total_products' => $total_products,
        'top_selling_products' => $top_selling_products,
        'order_statuses' => [
            [
                'status' => 'Order Submitted',
                'count' => Order::withDateFilter($request)->where('order_status_id',Constant::ORDER['SUBMITTED'])->count()
            ],
            [
                'status' => 'Order Placed',
                'count' => Order::withDateFilter($request)->where('order_status_id',Constant::ORDER['PLACED'])->count()
            ],
            [
                'status' => 'Processing',
                'count' => Order::withDateFilter($request)->where('order_status_id',Constant::ORDER['PROCESSING'])->count()
            ],
            [
                'status' => 'For Delivery',
                'count' => Order::withDateFilter($request)->where('order_status_id',Constant::ORDER['FOR_DELIVERY'])->count()
            ],
            [
                'status' => 'Delivered',
                'count' =>  Order::withDateFilter($request)->where('order_status_id',Constant::ORDER['DELIVERED'])->count()
            ],
            [
                'status' => 'Completed',
                'count' =>  Order::withDateFilter($request)->where('order_status_id',Constant::ORDER['COMPLETED'])->count()
            ],
            [
                'status' => 'Cancelled',
                'count' =>  Order::withDateFilter($request)->where('order_status_id',Constant::ORDER['CANCELLED'])->count()
            ]
        ],
        'monthly_sales_revenue_orders' => [
            [
                'month' => 'January',
                'sales' => OrderItem::getSalesCount($year, Constant::MONTH['JANUARY']),
                'orders' => Order::monthlyOrders(Constant::MONTH['JANUARY'], $year),
                'revenue' => OrderItem::getRevenueCount($year, Constant::MONTH['JANUARY'])
            ],
            [
                'month' => 'February',
                'sales' => OrderItem::getSalesCount($year, Constant::MONTH['FEBRUARY']),
                'orders' => Order::monthlyOrders(Constant::MONTH['FEBRUARY'], $year),
                'revenue' => OrderItem::getRevenueCount($year, Constant::MONTH['FEBRUARY'])
            ],
            [
                'month' => 'March',
                'sales' => OrderItem::getSalesCount($year, Constant::MONTH['MARCH']),
                'orders' => Order::monthlyOrders(Constant::MONTH['MARCH'], $year),
                'revenue' => OrderItem::getRevenueCount($year, Constant::MONTH['MARCH'])
            ],
            [
                'month' => 'April',
                'sales' => OrderItem::getSalesCount($year, Constant::MONTH['APRIL']),
                'orders' => Order::monthlyOrders(Constant::MONTH['APRIL'], $year),
                'revenue' => OrderItem::getRevenueCount($year, Constant::MONTH['APRIL'])
            ],
            [
                'month' => 'May',
                'sales' => OrderItem::getSalesCount($year, Constant::MONTH['MAY']),
                'orders' => Order::monthlyOrders(Constant::MONTH['MAY'], $year),
                'revenue' => OrderItem::getRevenueCount($year, Constant::MONTH['MAY'])
            ],
            [
                'month' => 'June',
                'sales' => OrderItem::getSalesCount($year, Constant::MONTH['JUNE']),
                'orders' => Order::monthlyOrders(Constant::MONTH['JUNE'], $year),
                'revenue' => OrderItem::getRevenueCount($year, Constant::MONTH['JUNE'])
            ],
            [
                'month' => 'July',
                'sales' => OrderItem::getSalesCount($year, Constant::MONTH['JULY']),
                'orders' => Order::monthlyOrders(Constant::MONTH['JULY'], $year),
                'revenue' => OrderItem::getRevenueCount($year, Constant::MONTH['JULY'])
            ],
            [
                'month' => 'August',
                'sales' => OrderItem::getSalesCount($year, Constant::MONTH['AUGUST']),
                'orders' => Order::monthlyOrders(Constant::MONTH['AUGUST'], $year),
                'revenue' => OrderItem::getRevenueCount($year, Constant::MONTH['AUGUST'])
            ],
            [
                'month' => 'September',
                'sales' => OrderItem::getSalesCount($year, Constant::MONTH['SEPTEMBER']),
                'orders' => Order::monthlyOrders(Constant::MONTH['SEPTEMBER'], $year),
                'revenue' => OrderItem::getRevenueCount($year, Constant::MONTH['SEPTEMBER'])
            ],
            [
                'month' => 'October',
                'sales' => OrderItem::getSalesCount($year, Constant::MONTH['OCTOBER']),
                'orders' => Order::monthlyOrders(Constant::MONTH['OCTOBER'], $year),
                'revenue' => OrderItem::getRevenueCount($year, Constant::MONTH['OCTOBER'])
            ],
            [
                'month' => 'November',
                'sales' => OrderItem::getSalesCount($year, Constant::MONTH['NOVEMBER']),
                'orders' => Order::monthlyOrders(Constant::MONTH['NOVEMBER'], $year),
                'revenue' => OrderItem::getRevenueCount($year, Constant::MONTH['NOVEMBER'])
            ],
            [
                'month' => 'December',
                'sales' => OrderItem::getSalesCount($year, Constant::MONTH['DECEMBER']),
                'orders' => Order::monthlyOrders(Constant::MONTH['DECEMBER'], $year),
                'revenue' => OrderItem::getRevenueCount($year, Constant::MONTH['DECEMBER'])
            ],
        ],
   
        'recent_reviews' => [],
    ];
 

    //    return Order::withDateFilter($request)->get();
 
    }
}






















// use App\Models\Session;

// return Session::query()
// ->join('users','sessions.user_id', '=', 'users.id')
// ->select('sessions.*', 'users.email')
// ->get();


//  // Get time session life time from config.
//  $time =  time() - (config('session.lifetime')*60); 

// //  // Total login users (user can be log on 2 devices will show once.)
// //  $totalActiveUsers = sessions::where('last_activity','>=', $time)->
// //  count(DB::raw('DISTINCT user_id'));

//  // Total active sessions
// $totalActiveUsers = Session::where('last_activity','>=', $time)->get();

// return $totalActiveUsers;