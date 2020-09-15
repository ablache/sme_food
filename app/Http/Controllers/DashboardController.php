<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Customer;
use App\Supplier;
use App\Expense;
use \Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
  public function index() {
    $title = 'Dashboard';

    $today = Carbon::now();
    $weekStart = $today->copy()->subWeek();
    $monthStart = $today->copy()->startOfMonth();

    $counts['total_items'] = DB::table('order_product')->count();
    $counts['total_orders'] = Order::count();
    $counts['pending_orders'] = Order::where('delivery_status', '<>', 'delivered')->count();
    $counts['total_customers'] = Customer::count();
    $counts['total_suppliers'] = Supplier::count();

    $weeklyOrders = Order::where('created_at', '>', $weekStart)
                            ->where('delivery_status', 'delivered')
                            ->groupBy('date')
                            ->orderBy('date', 'DESC')
                            ->get(array(
                                DB::raw('Date(created_at) as date'),
                                DB::raw('COUNT(*) as "orders"')
                            ));

    $weeklyMax = 0;

    foreach($weeklyOrders as $wo) {
      if($wo->orders > $weeklyMax) {
        $weeklyMax = $wo->orders;
      }
    }

    $dailyExpenses = Expense::where('created_at', '>', $monthStart)
                                ->where('created_at', '<=', $today)
                                ->groupBy('date')
                                ->get(array(
                                  DB::raw('DAY(created_at) as date'),
                                  DB::raw('SUM(price) as amount')
                                ));
    
    $dailyExpenses = json_encode($dailyExpenses);

    return view('home.dashboard', compact('title', 'counts', 'weeklyOrders', 'weeklyMax', 'dailyExpenses'));
  }
}
