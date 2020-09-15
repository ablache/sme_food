<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Order;
use App\Product;
use App\Http\Resources\OrderResource;

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
    $order = null;

    return view('orders.add', compact('title', 'order'));
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

  public function delivery(Request $request, $id) {
    $order = Order::findOrFail($id);
    $order->delivery_status = $request->status;
    $order->save();

    return redirect()->route('orders.view', ['id' => $order->id])->with(['success' => 'Delivery status updated successfully.']);
  }

  public function paymentMethod(Request $request, $id) {
    $order = Order::findOrFail($id);
    $order->payment_method = $request->status;
    $order->save();

    return redirect()->route('orders.view', ['id' => $order->id])->with(['success' => 'Payment method updated successfully.']);
  }

  public function paymentStatus(Request $request, $id) {
    $order = Order::findOrFail($id);
    $order->payment_status = $request->status;
    $order->save();

    return redirect()->route('orders.view', ['id' => $order->id])->with(['success' => 'Payment status updated successfully.']);
  }

  public function edit($id) {
    $title = 'Edit Order';
    $orderRes = Order::findOrFail($id);
    $order = OrderResource::make($orderRes);

    return view('orders.add', compact('title', 'order'));
  }

  public function update(OrderRequest $request, $id) {
    $order = Order::findOrFail($id);
    $products = $request->products;

    $order->products()->detach();
    
    foreach($products as $p) {
      $product = Product::findOrFail($p['id']);
      $data['quantity'] = $p['qty'];
      if(array_key_exists('prefs', $p)) {
        $data['preferences'] = json_encode($p['prefs']);
      }

      $order->products()->attach($product->id, $data);

      unset($data);
    }
    
    $order->update($request->all());
    
    return response()->json(['success' => 'ok'], 200);
  } 
}
