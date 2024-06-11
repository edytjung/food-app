@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Product Category</h1>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>Create Product Category</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1" @selected($category->status === 1)>Active</option>
                        <option value="0" @selected($category->status === 0)>Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Show at Home</label>
                    <select name="show_at_home" class="form-control">
                        <option value="1" @selected($category->show_at_home === 1)>Yes</option>
                        <option value="0" @selected($category->show_at_home === 0)>No</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</section>
@endsection
