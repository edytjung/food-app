@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Why Choose Us</h1>
    </div>

    <div class="card card-primary">
        <div class="card-header">
            <h4>Update Why Choose Us</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.why-choose-us.update', $WhyChooseUs->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Icon</label>
                    <!-- Button tag -->
                    <button data-icon="{{ $WhyChooseUs->icon }}" class="btn btn-primary" role="iconpicker" name="icon"></button>
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $WhyChooseUs->title }}">
                </div>
                <div class="form-group">
                    <label>Short Description</label>
                    <textarea name="short_description" class="form-control">{{ $WhyChooseUs->short_description }}</textarea>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="1" @selected($WhyChooseUs->status === 1)>Active</option>
                        <option value="0" @selected($WhyChooseUs->status === 0)>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</section>
@endsection
