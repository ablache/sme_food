<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductTypeRequest;
use App\Type;

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
}
