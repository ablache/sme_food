<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Http\Requests\SupplierRequest;

class SupplierController extends Controller
{
  public function index() {
    $title = 'Suppliers';
    $suppliers = Supplier::all();

    return view('suppliers.manage', compact('title', 'suppliers'));
  }

  public function create() {
    $title = 'Add Supplier';

    return view('suppliers.add', compact('title'));
  }

  public function store(SupplierRequest $request) {
    $supplier = Supplier::create($request->validated());

    return redirect()->route('suppliers')->with(['success' => 'Supplier added successfully']);
  }
}
