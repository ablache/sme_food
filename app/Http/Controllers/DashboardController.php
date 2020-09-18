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

    $pendingOrders = Order::where('delivery_status', '<>', 'delivered')->get();
    $counts['total_items'] = DB::table('order_product')->get(DB::raw('SUM(quantity) as items'))->pluck('items')->toArray()[0];
    $counts['total_orders'] = Order::count();
    $counts['pending_orders'] = count($pendingOrders);
    $counts['total_customers'] = Customer::count();
    $counts['total_suppliers'] = Supplier::count();
    $counts['pending_items'] = 0;

    foreach($pendingOrders as $po) {
      foreach($po->products as $item) {
        $counts['pending_items'] += $item->pivot->quantity;
      }
    }

    $weeklyOrders = Order::where('deliver_at', '>', $weekStart)
                            ->where('delivery_status', 'delivered')
                            ->groupBy('date')
                            ->orderBy('date', 'DESC')
                            ->get(array(
                                DB::raw('Date(deliver_at) as date'),
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
