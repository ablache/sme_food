<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Order;

class OrderController extends Controller
{
  public function index() {
    $title = 'Orders';
    $orders = Order::orderBy('created_at', 'desc')->paginate(10);

    return view('orders.manage', compact('title', 'orders'));
  }

  public function show($id) {

  }

  public function create() {
    $title = 'Place Order';

    return view('orders.add', compact('title'));
  }

  public function store(OrderRequest $request) {
    return response()->json(['success' => 'ok'], 200);
  }
}
