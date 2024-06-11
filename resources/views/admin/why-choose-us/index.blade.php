@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Why Choose Us</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <div id="accordion">
                    <div class="accordion">
                        <div class="accordion-header collapsed bg-primary text-white" role="button" data-toggle="collapse"
                            data-target="#panel-body-1" aria-expanded="false">
                            <h4>Why Choose Us Section Title</h4>
                        </div>
                        <div class="accordion-body collapse" id="panel-body-1" data-parent="#accordion" style="">
                            <form action="{{ route('admin.why-choose-title.update') }}" class="form-group" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="topTitle">Top Title</label>
                                    <input type="text" name="why_choose_top_title" class="form-control"
                                        value="{{ $titles['why_choose_top_title'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="mainTitle">Main Title</label>
                                    <input type="text" name="why_choose_main_title" class="form-control"
                                        value="{{ $titles['why_choose_main_title'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="subTitle">Sub Title</label>
                                    <input type="text" name="why_choose_sub_title" class="form-control"
                                        value="{{ $titles['why_choose_sub_title'] }}">
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>All Why Choose Us</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.why-choose-us.create') }}" class="btn btn-primary">
                        Create New
                    </a>
                </div>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
