<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfilePasswordUpdateRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Models\Admin\Product\Product;
use App\Traits\FileUploadTrait;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    use FileUploadTrait;

    function updateProfile(ProfileUpdateRequest $request) : RedirectResponse
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        toastr()->success('Profile updated successfully');

        return redirect()->back();
    }

    function updatePassword(ProfilePasswordUpdateRequest $request) : RedirectResponse
    {
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        toastr('Password updated successfully.', 'success');

        return redirect()->back();
    }

    function updateAvatar(Request $request)
    {
        // dd($request->all());
        $imagePath = $this->uploadImage($request, 'avatar');
        $user = Auth::user();
        $user->avatar = isset($imagePath) ? $imagePath : $user->avatar;
        $user->save();
        return response(['status'=>'success', 'message'=>'Avatar Updated Successfully']);
    }

    function loadProductModal($productId) {
        $product = Product::with(['productSizes','productOptions'])->findOrFail($productId);
        return view('frontend.layouts.ajax-files.product-popup-modal', compact('product'))->render();
    }
}
