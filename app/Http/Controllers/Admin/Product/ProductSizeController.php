<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product\Product;
use App\Models\Admin\Product\ProductOption;
use App\Models\Admin\Product\ProductSize;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $productId)
    {
        $sizes = ProductSize::where('product_id', $productId)->get();
        $options = ProductOption::where('product_id', $productId)->get();
        $product = Product::findOrFail($productId);

        return view('admin.product.product-size.index', compact( 'sizes', 'options','product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'price' => ['required', 'numeric'],
        ]);

        $size = new ProductSize();
        $size->product_id = $request->product_id;
        $size->name = $request->name;
        $size->price = $request->price;
        $size->save();

        toastr('Product Size Successfully','success');

        return to_route('admin.product-size.show-index', $request->product_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $size = ProductSize::findOrFail($id);
            $size->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully']);
        }catch( \Exception $e){
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
