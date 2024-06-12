@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Sizes ({{ $product->name }})</h1>
        </div>

        <div class="card card-primary">
            <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Go Back</a>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Create Product Size</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.product-size.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control">
                                        <input type="hidden" name="product_id" class="form-control"
                                            value="{{ $product->id }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Price</label>
                                        <input type="text" name="price" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($sizes as $size)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $size->name }}</td>
                                        <td>{{ $size->price }}</td>
                                        <td>
                                            <a href="{{ route('admin.product-size.destroy', $size->id) }}"
                                                class="delete-item btn btn-danger mx-2"><i
                                                    class='fas fa-minus-circle'></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">
                                            No Data Found...
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Create Product Option</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.product-option.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control">
                                        <input type="hidden" name="product_id" class="form-control"
                                            value="{{ $product->id }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Price</label>
                                        <input type="text" name="price" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($options as $option)
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $option->name }}</td>
                                        <td>{{ $option->price }}</td>
                                        <td>
                                            <a href="{{ route('admin.product-option.destroy', $option->id) }}"
                                                class="delete-item btn btn-danger mx-2"><i
                                                    class='fas fa-minus-circle'></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">
                                            No Data Found...
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
