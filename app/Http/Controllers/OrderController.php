<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Order;
use App\Product;

class OrderController extends Controller
{
  public function index() {
    $title = 'Orders';
    $orders = Order::orderBy('created_at', 'desc')->paginate(10);

    return view('orders.manage', compact('title', 'orders'));
  }

  public function show($id) {
    $title = 'View Order';
    $order = Order::findOrFail($id);
    $subTotal = 0;
    $deliveryStatuses = ['delivered','not delivered','not answering'];
    $paymentMethods = ['transfer','cash'];
    $paymentStatuses = ['paid','not paid'];

    return view('orders.view', compact('title', 'order', 'subTotal', 'deliveryStatuses', 'paymentMethods', 'paymentStatuses'));
  }

  public function create() {
    $title = 'Place Order';

    return view('orders.add', compact('title'));
  }

  public function store(OrderRequest $request) {
    $order = Order::create($request->all());
    $products = $request->products;

    foreach($products as $p) {
      $product = Product::findOrFail($p['id']);
      $data['quantity'] = $p['qty'];
      if(array_key_exists('prefs', $p)) {
        $data['preferences'] = json_encode($p['prefs']);
      }

      $order->products()->save($product, $data);

      unset($data);
    }
    
    return response()->json(['success' => 'ok'], 200);
  }
}
