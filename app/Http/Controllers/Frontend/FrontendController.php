<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product\Category;
use App\Models\Admin\Product\Product;
use App\Models\SectionTable;
use App\Models\Slider;
use App\Models\WhyChooseUs;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class FrontendController extends Controller
{
    function index(): View {
        $sliders = Slider::where('status',1)->get();

        $sectionTitles = $this->getSectionTitle();
        $wcus = WhyChooseUs::where('status', 1)->get();

        $categories = Category::where('status', 1)->where('show_at_home',1)->get();
        $products = Product::where('status', 1)->where('show_at_home',1)->orderBy('id', 'desc')->take(8)->get();

        return view('frontend.home.index', compact('sliders', 'sectionTitles', 'wcus', 'categories', 'products'));
    }

    function getSectionTitle() : Collection {
        $keys = [
            'why_choose_top_title',
            'why_choose_main_title',
            'why_choose_sub_title'
        ];

        return SectionTable::whereIn('key', $keys)->pluck('value','key');
    }

    function showProduct(string $slug): View {

        $product = Product::with(['galleries','productSizes','productOptions'])->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::where('category_id',$product->category_id)
                                    ->where('id', '!=', $product->id)
                                    ->where('status', 1)
                                    ->take(8)
                                    ->latest()
                                    ->get();

        return view('frontend.pages.product-view', compact('product','relatedProducts'));
    }
}
