<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductTypeRequest;
use App\ProductType;

class ProductTypeController extends Controller
{
  public function index() {
    $title = 'Product Types';
    $productTypes = ProductType::all();

    return view('product-types.manage', compact('title', 'productTypes'));
  }

  public function create() {
    $title = 'Add Product Type';

    return view('product-types.add', compact('title'));
  }

  public function store(ProductTypeRequest $request) {
    $productType = ProductType::create($request->validated());

    return redirect()->route('product-types')->with(['success' => 'Product type added successfully']);
  }
}
