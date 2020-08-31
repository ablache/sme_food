<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductPreferenceRequest;
use App\Preference;

class ProductPreferenceController extends Controller
{
  public function index() {
    $title = 'Product Preferences';
    $productPreferences = Preference::all();

    return view('product-preferences.manage', compact('title', 'productPreferences'));
  }

  public function create() {
    $title = 'Add Product Preference';

    return view('product-preferences.add', compact('title'));
  }

  public function store(ProductPreferenceRequest $request) {
    $productPreference = Preference::create($request->validated());

    return redirect()->route('product-preferences')->with(['success' => 'Product preference added successfully']);
  }
}
