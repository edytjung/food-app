<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product\Product;
use App\Models\Admin\Product\ProductGallery;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class ProductGalleryContoller extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(string $productId)
    {
        $images = ProductGallery::where('product_id', $productId)->get();
        $product = Product::findOrFail($productId);
        return view('admin.product.gallery.index', compact('images', 'product'));
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
            'image' => ['required','image', 'max:20000'],
            'product_id' => ['required'],
        ]);

        $imagePath = $this->uploadImage($request, 'image');

        $productGallery = new ProductGallery();
        $productGallery->product_id = $request->product_id;
        $productGallery->image = $imagePath;
        $productGallery->save();

        toastr('Upload Image Galllery Successfully','success');

        return to_route('admin.product-gallery.show-index', $request->product_id);
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
            $image = ProductGallery::findOrFail($id);
            $this->removeImage($image->image);
            $image->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully']);
        }catch( \Exception $e){
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
