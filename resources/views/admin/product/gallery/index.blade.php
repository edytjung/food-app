@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Galleries {{ $product->name }}</h1>
        </div>

        <div class="card card-primary">
            <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Go Back</a>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>All Product Galleries</h4>
            </div>
            <div class="card-body">
                <div class="col-md-8">
                    <form action="{{ route('admin.product-gallery.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="form-group">
                            <input name="image" type="file" class="form-control">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($images as $image)
                            <tr>
                                <td>
                                    <img src="{{ asset($image->image) }}" width="150">
                                </td>
                                <td>
                                    {{-- <a href="{{ route('admin.product-gallery.edit', $image->id) }}" class="btn btn-primary mx-2"><i class="fas fa-edit"></i></a> --}}
                                    <a href="{{ route('admin.product-gallery.destroy', $image->id) }}" class="delete-item btn btn-danger mx-2"><i class='fas fa-minus-circle'></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($images) === 0)
                            <tr>
                                <td colspan="2">
                                    No Data Found...
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
            </div>
        </div>
    </section>
@endsection
