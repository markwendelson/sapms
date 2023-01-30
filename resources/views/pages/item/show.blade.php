@extends('layouts.v1')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Items</h4>

            <div class="page-title-right">
                <a href="{{route('item.edit', $item->id)}}" class="btn btn-primary waves-effect waves-light">
                    <i class="bx bx-pencil font-size-16 align-middle me-2"></i> Edit
                </a>
                <a href="{{route('reports.property-card', ['id' => $item->id])}}" class="btn btn-primary waves-effect waves-light">
                    <i class="bx bx-printer font-size-16 align-middle me-2"></i> Print Property Card
                </a>
            </div>
        </div>

        @include('partials.message')

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <table class="table table-bordered dt-responsive  nowrap w-100">
                            <tr>
                                <td>Item Code:</td>
                                <td>{{$item->code}}</td>
                                <td>Item Category:</td>
                                <td>{{$item->category}}</td>
                                <td>Item Price:</td>
                                <td>{{$item->price}}</td>
                            </tr>
                            <tr>
                                <td>Item Name:</td>
                                <td colspan="3">{{$item->name}}</td>
                                <td>Quantity:</td>
                                <td>{{$item->quantity.' '.$item->unit_of_measure}}</td>
                            </tr>
                            <tr>
                                <td>Description:</td>
                                <td colspan="6">{{$item->description}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
@endpush
