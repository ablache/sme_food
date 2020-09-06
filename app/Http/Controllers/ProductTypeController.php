<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductTypeRequest;
use App\Type;
use App\Http\Requests\ConfirmRequest;

class ProductTypeController extends Controller
{
  public function index() {
    $title = 'Product Types';
    $productTypes = Type::all();

    return view('product-types.manage', compact('title', 'productTypes'));
  }

  public function create() {
    $title = 'Add Product Type';

    return view('product-types.add', compact('title'));
  }

  public function store(ProductTypeRequest $request) {
    $productType = Type::create($request->validated());

    return redirect()->route('product-types')->with(['success' => 'Product type added successfully']);
  }

  public function edit($id) {
    $title = 'Edit Product Type';
    $model = Type::findOrFail($id);

    return view('product-types.edit', compact('title', 'model'));
  }

  public function update(ProductTypeRequest $request, $id) {
    $productType = Type::findOrFail($id);
    $productType->update($request->all());

    return redirect()->route('product-types')->with(['success' => 'Product type updated successfully']);
  }

  public function destroy(ConfirmRequest $request, $id) {
    $productType = Type::findOrFail($id);
    $productType->delete();

    return redirect()->route('product-types')->with(['success' => 'Product type removed successfully']);
  }
}
