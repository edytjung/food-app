@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product</h1>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Create Product</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Image</label>
                        <div class="col-sm-12 col-md-7">
                            <div id="image-preview" class="image-preview">
                                <label for="image-upload" id="image-label">Choose File</label>
                                <input type="file" name="thumb_image" id="image-upload">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') ?  old('name') : $product->name }}">
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control select2">
                            <option value="">Please Select</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id === $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea class="form-control" name="short_description" class="form-control">{{ old('short_description') ?  old('short_description') : $product->short_description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Long Description</label>
                        <textarea class="form-control summernote" name="long_description" id="">{!! old('long_description') ?  old('long_description') : $product->long_description !!}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control" value="{{ old('price') ?  old('price') : $product->price}}">
                    </div>
                    <div class="form-group">
                        <label>Offer Price</label>
                        <input type="text" name="offer_price" class="form-control" value="{{ old('offer_price') ?  old('offer_price') : $product->offer_price }}">
                    </div>
                    <div class="form-group">
                        <label>SKU</label>
                        <input type="text" name="sku" class="form-control" value="{{ old('sku') ?  old('sku') : $product->sku }}">
                    </div>
                    <div class="form-group">
                        <label>SEO Title</label>
                        <input type="text" name="seo_title" class="form-control" value="{{ old('seo_title') ?  old('seo_title') : $product->seo_title }}">
                    </div>
                    <div class="form-group">
                        <label>SEO Description</label>
                        <textarea name="seo_description" class="form-control">{{ old('seo_description') ?  old('seo_description') : $product->seo_description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Show at Home</label>
                        <select name="show_at_home" class="form-control">
                            <option value="1" @selected(old('show_at_home') ? old('show_at_home') === 1 : $product->show_at_home === 1)>Yes</option>
                            <option value="0" @selected(old('show_at_home') ? old('show_at_home') === 0 : $product->show_at_home === 0)>No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" @selected(old('status') ? old('status') === 1 : $product->status === 1)>Yes</option>
                            <option value="0" @selected(old('status') ? old('status') === 0 : $product->status === 0)>No</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.image-preview').css({
                'background-image': 'url({{ asset($product->thumb_image) }})',
                'background-size': 'cover',
                'background-position': 'center center'
            })
        })
    </script>
@endpush
