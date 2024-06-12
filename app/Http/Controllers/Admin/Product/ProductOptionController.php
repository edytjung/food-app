<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product\ProductOption;
use Illuminate\Http\Request;

class ProductOptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'price' => ['required', 'numeric'],
        ],[
            'name.required' => 'Product option name is required',
            'price.required' => 'Product option price is required',
            'name.max' => 'Product option max length is 255',
            'price.numeric' => 'Product option price must be numeric',
        ]);

        $size = new ProductOption();
        $size->product_id = $request->product_id;
        $size->name = $request->name;
        $size->price = $request->price;
        $size->save();

        toastr('Product Option Created Successfully','success');

        return to_route('admin.product-size.show-index', $request->product_id);
    }
    public function destroy(string $id)
    {
        try{
            $size = ProductOption::findOrFail($id);
            $size->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully']);
        }catch( \Exception $e){
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
