<?php

namespace App\Http\Controllers\Admin\Product;

use App\DataTables\CategoryProductDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryCreateRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Models\Admin\Product\Category;
use Illuminate\Http\Request;
use Str;

class CategoryController extends Controller
{
    public function index(CategoryProductDataTable $dataTable)
    {

        return $dataTable->render('admin.product.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;
        $category->show_at_home = $request->show_at_home;
        $category->save();

        toastr()->success('Category Created Successfully');
        return to_route('admin.category.index');
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
        $category = Category::findOrFail($id);

        return view('admin.product.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;
        $category->show_at_home = $request->show_at_home;
        $category->save();

        toastr()->success('Category Updated Successfully');
        return to_route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $wcu = Category::findOrFail($id);
            $wcu->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully']);
        }catch( \Exception $e){
            return response(['status' => 'error', 'message' => 'Data not found...']);
        }
    }
}
