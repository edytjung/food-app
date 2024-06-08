<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SlidersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderCreateRequest;
use App\Http\Requests\Admin\SliderUpdateRequest;
use App\Models\Slider;
use App\Traits\FileUploadTrait;
use Exception;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(SlidersDataTable $dataTable)
    {

        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderCreateRequest $request)
    {
        // Handle Image Upload
        $imagePath = $this->uploadImage($request, 'image');

        $slide = new Slider();
        $slide->offer = $request->offer;
        $slide->image = $imagePath;
        $slide->title = $request->title;
        $slide->subtitle = $request->subtitle;
        $slide->short_description = $request->short_description;
        $slide->button_link = $request->button_link;
        $slide->status = $request->status;
        $slide->save();

        toastr()->success('Created Successfully');

        return to_route('admin.slider.index');
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
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderUpdateRequest $request, string $id)
    {
        // Handle Image Upload

        $slide = Slider::findOrFail($id);

        $imagePath = $this->uploadImage($request, 'image', $slide->image);

        // image handle
        // if(isset($request->image)){
        //     $slide->image = $imagePath;
        // }

        $slide->offer = $request->offer;
        $slide->image = !empty($imagePath) ? $imagePath : $slide->image;
        $slide->title = $request->title;
        $slide->subtitle = $request->subtitle;
        $slide->short_description = $request->short_description;
        $slide->button_link = $request->button_link;
        $slide->status = $request->status;
        $slide->save();

        toastr()->success('Slider Updated Successfully');

        return to_route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $slider = Slider::findOrFail($id);
            $slider->delete();
            return response(['status' => 'success', 'message' => 'Deleted Successfully']);
        }catch( \Exception $e){
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
