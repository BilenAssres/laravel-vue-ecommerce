<?php

namespace App\Http\Controllers;

use App\Models\Image as ModelsImage;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth', ['except' => ['index', 'detail']]);
    }

    public function index(Request $request)
    {
        $products = Product::with('images')->simplePaginate(50);
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|min:10|max:256',
            'product_price' => 'required|numeric|min:1',
            'product_seller' => 'required|string',
            'product_status' => 'required|string',
            'product_detail' => 'required|string',
            'product_image' => 'required|array',
            'product_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $product = Product::create($request->except('product_image'));
        foreach ($request->file('product_image') as $image) {
            $img = $image->store('Products', 'public');
            Image::make(public_path('/storage/' . $img))->fit(1000, 1000)->save();
            ModelsImage::create([
                'img_url' => $img,
                'product_id' => $product->id
            ]);
        }


        return redirect()->route('admin.dashboard')->with('alert', 'Product successfully created');
    }


    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required|string|min:10|max:256',
            'product_price' => 'required|numeric|min:1',
            'product_seller' => 'required|string',
            'product_status' => 'required|string',
            'product_detail' => 'required|string',

        ]);

        $product->update($request->except('product_image'));

        if ($request->hasFile('product_images')) {
            ModelsImage::where('product_id', $product->id)->delete();
            foreach ($request->file('product_image') as $image) {
                $img = $image->store('Products', 'public');
                Image::make(public_path('/storage/' . $img))->fit(1000, 1000)->save();
                ModelsImage::create([
                    'img_url' => $img,
                    'product_id' => $product->id
                ]);
            }
        }


        return redirect()->route('admin.dashboard')->with('alert', 'Product successfully created');
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', Product::class);
        $product->delete();

        return redirect()->back()->with('alert', 'Products successfully remove');
    }
}
