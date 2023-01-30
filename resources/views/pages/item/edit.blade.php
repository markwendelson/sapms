@extends('layouts.v1')

@push('extra_css')
<link href="{{ asset('/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{ asset('/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Edit Item</h4>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        @include('partials.errors')

                        <form action="{{route('item.update', $item)}}" method="POST" id="form">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 row">
                                <label for="code" class="col-md-2 col-form-label">Code</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" value="{{old('code') ?? $item->code}}" id="code" name="code">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="name" class="col-md-2 col-form-label">Name</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" value="{{old('name') ?? $item->name}}" id="name" name="name">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="description" class="col-md-2 col-form-label">Description</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" type="text" id="description" name="description">{{old('description') ?? $item->description}}</textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="quantty" class="col-md-2 col-form-label">Quantity</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" value="{{old('quantity') ?? $item->quantity}}" id="quantity" name="quantity">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="unit_of_measure" class="col-md-2 col-form-label">Unit of Measure</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="unit_of_measure" id="unit_of_measure">
                                        <option value="" disabled selected>Select...</option>
                                        @foreach (config('constants.unit_of_measure') as $unit_of_measure)
                                            <option value="{{$unit_of_measure}}" {{ $item->unit_of_measure == $unit_of_measure ? 'selected' : ''}}>{{$unit_of_measure}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="price" class="col-md-2 col-form-label">Price</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" value="{{old('price') ?? $item->price}}" id="price" name="price" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="category" class="col-md-2 col-form-label">Category</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="category" id="category" required>
                                        <option value="" disabled selected>Select...</option>
                                        @php
                                            $categories = config('constants.category');
                                            sort($categories);
                                        @endphp
                                        @foreach ($categories as $category)
                                            <option value="{{$category}}" {{ $item->category == $category ? 'selected':'' }}>{{$category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-2" style="float:right">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    <i class="bx bx-save font-size-16 align-middle me-2"></i> Update
                                </button>
                                <a href="{{route('item.index')}}" class="btn btn-secondary waves-effect">
                                    <i class="bx bx-x font-size-16 align-middle me-2"></i> Cancel
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')

@endpush
