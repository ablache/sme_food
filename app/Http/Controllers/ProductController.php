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
}
