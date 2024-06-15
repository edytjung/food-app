<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    function addToCart(Request $request){
        try{
            $product = Product::with(['productSizes', 'productOptions'])->findOrFail($request->product_id);

            $productSize = $product->productSizes->where('id', $request->product_size)->first();

            $productOptions = $product->productOptions->whereIn('id',$request->product_option);

            $options = [
                'product_size' => [],
                'product_options' => [],
                'product_info' => [
                    'image' => $product->thumb_image,
                    'slug' => $product->slug
                ],
            ];

            if($productSize !== null){
            $options['product_size']=[
                'id' => $productSize?->id,
                'name' => $productSize?->name,
                'price' => $productSize?->price,
            ];
            }

            foreach($productOptions as $option){
                $options['product_options'][]=[
                    'id' => $option->id,
                    'name' => $option->name,
                    'price' => $option->price,
                ];
            }

            Cart::add([
                'id'=> $product->id,
                'name'=> $product->name,
                'qty'=> $request->quantity,
                'price'=> $product->offer_price > 0 ? $product->offer_price:$product->price,
                'weight' => 0,
                'options' => $options
            ]);

            // Cart::destroy();

            return response([
                'status' => 'success',
                'message' => 'Product added into cart!'
            ],200);
        }catch(\Exception $e){
            return response([
                'status' => 'error',
                'message' => 'Something Wrong'
            ],500);
        }
    }

    function getCartProduct() {
        // Cart::destroy();
        return view('frontend.layouts.ajax-files.sidebar-cart-item')->render();

    }
}
