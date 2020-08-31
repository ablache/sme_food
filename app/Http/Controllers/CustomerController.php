<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Customer;

class CustomerController extends Controller
{
  public function index() {
    $title = 'Customers';
    $customers = Customer::orderBy('created_at', 'desc')->paginate(10);

    return view('customers.manage', compact('title', 'customers'));
  }

  public function create() {
    $title = 'Add Customer';

    return view('customers.add', compact('title'));
  }

  public function store(CustomerRequest $request) {
    $customer = Customer::create($request->validated());

    return redirect()->route('customers')->with(['success' => 'Customer added successfully']);
  }
}
