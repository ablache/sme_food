<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Type;
use App\Preference;
use Storage;
use Image;
use Illuminate\Support\Str;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ConfirmRequest;

class ProductController extends Controller
{
  public function index() {
    $title = 'Products';
    $products = Product::orderBy('created_at', 'desc')->paginate(3);

    return view('products.manage', compact('title', 'products'));
  }

  public function show($id) {
    $product = Product::findOrFail($id);
    $title = 'View Product ' . $product->name;

    return view('products.view', compact('title', 'product'));
  }

  public function create() {
    $title = 'Add Product';
    $types = Type::all();
    $preferences = Preference::all();

    return view('products.add', compact('title', 'types', 'preferences'));
  }

  public function store(ProductRequest $request) {
    $filepath = null;
    if($request->has('file')) {
      $file = $request->file('file');
      $ext = $file->getClientOriginalExtension();
      $directory = 'uploads/images/' . date('Y/m');
      $filename = (string) Str::uuid() . '.' . $ext;
      $filepath = $directory . '/' . $filename;

      if(!Storage::exists($directory)) {
        Storage::makeDirectory($directory);
      }

      $image = Image::make($file);
      $image->fit('320', '480', function($c) {
        $c->aspectRatio();
      });

      Storage::put($filepath, (string)$image->encode());
      $image->destroy();
    }

    $data = $request->all();
    $data['image'] = $filepath;

    $product = Product::create($data);
    if($request->has('preferences')) {
      $prefs = array_keys($request->preferences);
      $product->preferences()->sync($prefs);
    }

    return redirect()->route('products')->with(['success' => 'Product added successfully']);
  }

  public function search(Request $request) {
    $request->validate(['keyword' => 'required']);
    $keyword = $request->keyword;

    $products = Product::where('name', 'LIKE', '%' . $keyword . '%')
                          ->where('status', 'available')
                          ->limit(10)
                          ->get();

    return response()->json(['data' => ProductResource::collection($products)], 200);
  }

  public function edit($id) {
    $title = 'Edit Product';
    $model = Product::findOrFail($id);
    
    $types = Type::all();
    $preferences = Preference::all();

    return view('products.edit', compact('title', 'model', 'types', 'preferences'));
  }

  public function update(ProductRequest $request, $id) {
    $product = Product::findOrFail($id);

    $data = $request->all();

    if($request->has('file')) {
      $file = $request->file('file');
      $ext = $file->getClientOriginalExtension();
      $directory = 'uploads/images/' . date('Y/m');
      $filename = (string) Str::uuid() . '.' . $ext;
      $filepath = $directory . '/' . $filename;

      if(!Storage::exists($directory)) {
        Storage::makeDirectory($directory);
      }

      $image = Image::make($file);
      $image->fit('320', '480', function($c) {
        $c->aspectRatio();
      });

      Storage::put($filepath, (string)$image->encode());
      $image->destroy();
      $data['image'] = $filepath;
    }

    $product->update($data);

    if($request->has('preferences')) {
      $prefs = array_keys($request->preferences);
      $product->preferences()->sync($prefs);
    }

    return redirect()->route('products')->with(['success' => 'Product updated successfully']);
  }

  public function destroy(ConfirmRequest $request, $id) {
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->route('products')->with(['success' => 'Product deleted successfully']);
  }
}
