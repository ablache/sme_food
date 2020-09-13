<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Http\Requests\SupplierRequest;
use App\Http\Requests\ConfirmRequest;

class SupplierController extends Controller
{
  public function index() {
    $title = 'Suppliers';
    $suppliers = Supplier::orderBy('name', 'asc')->paginate(10);

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

  public function edit($id) {
    $title = 'Edit Supplier Details';
    $model = Supplier::findOrFail($id);

    return view('suppliers.edit', compact('title', 'model'));
  }

  public function update(SupplierRequest $request, $id) {
    $supplier = Supplier::findOrFail($id);
    $supplier->update($request->all());

    return redirect()->route('suppliers')->with(['success' => 'Supplier updated successfully.']);
  }

  public function destroy(ConfirmRequest $request, $id) {
    $supplier = Supplier::findOrFail($id);
    $supplier->delete();

    return redirect()->route('suppliers')->with(['success' => 'Supplier removed successfully.']);
  }
}
