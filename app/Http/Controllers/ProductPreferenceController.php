<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductPreferenceRequest;
use App\Preference;
use App\Http\Requests\ConfirmRequest;

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

  public function edit($id) {
    $title = 'Edit Product Preference';
    $model = Preference::findOrFail($id);

    return view('product-preferences.edit', compact('title', 'model'));
  }

  public function update(ProductPreferenceRequest $request, $id) {
    $productPreference = Preference::findOrFail($id);
    $productPreference->update($request->all());

    return redirect()->route('product-preferences')->with(['success' => 'Product preference updated successfully']);
  }

  public function destroy(ConfirmRequest $request, $id) {
    $productPreference = Preference::findOrFail($id);
    $productPreference->delete();

    return redirect()->route('product-preferences')->with(['success' => 'Product preference removed successfully']);
  }
}
