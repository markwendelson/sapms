@extends('layouts.v1')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Supplies - {{$item->name}}</h4>

            <div class="page-title-right">
                <a href="{{route('item.edit', $item->id)}}" class="btn btn-primary waves-effect waves-light">
                    <i class="bx bx-pencil font-size-16 align-middle me-2"></i> Edit
                </a>
            </div>
        </div>

        @include('partials.message')

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            @if($item->type == 'semi-expendable')
                                <h4 class="mb-sm-0 font-size-18">Semi-expendable Property Information</h4>
                            @else
                                <h4 class="mb-sm-0 font-size-18">Property Information</h4>
                            @endif
                        </div>

                        <table class="table table-bordered dt-responsive  nowrap w-100">
                            <tr>
                                <td class="title" width="100px">Item Code:</td>
                                <td>{{$item->code}}</td>
                                <td class="title" width="125px">Item Category:</td>
                                <td>{{$item->category}}</td>
                                <td class="title" width="95px">Item Price:</td>
                                <td>{{$item->price}}</td>
                            </tr>
                            <tr>
                                <td class="title">Item Name:</td>
                                <td colspan="3">{{$item->name}}</td>
                                <td class="title">Quantity:</td>
                                <td>{{$item->quantity.' '.$item->unit_of_measure}}</td>
                            </tr>
                            <tr>
                                <td class="title">Brand:</td>
                                <td>{{$item->brand}}</td>
                                <td class="title">Model:</td>
                                <td>{{$item->model}}</td>
                                <td class="title">Serial No.</td>
                                <td>{{$item->serial_no}}</td>
                            </tr>
                            <tr>
                                <td class="title">Description:</td>
                                <td colspan="6">{{$item->description}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            @if($item->type == 'semi-expendable')
                                <h4 class="mb-sm-0 font-size-18">Semi-expendable Property Card</h4>

                                <div class="page-title-right">
                                    <a href="{{route('reports.property-card', ['id' => $item->id])}}" class="btn btn-primary waves-effect waves-light" target="_blank">
                                        <i class="bx bx-printer font-size-16 align-middle me-2"></i> Print
                                    </a>
                                </div>
                            @else
                                <h4 class="mb-sm-0 font-size-18">Property Card</h4>

                                <div class="page-title-right">
                                    <a href="{{route('reports.property-card', ['id' => $item->id])}}" class="btn btn-primary waves-effect waves-light" target="_blank">
                                        <i class="bx bx-printer font-size-16 align-middle me-2"></i> Print
                                    </a>
                                </div>
                            @endif
                        </div>

                        <table class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <td rowspan="2">DATE</td>
                                    <td rowspan="2">REFERENCE NO.</td>
                                    <td rowspan="2">RECEIPT QTY</td>
                                    <td colspan="2">ISSUE/TRANSFER/DISPOSAL</td>
                                    <td rowspan="2">BALANCE QTY</td>
                                    <td rowspan="2">AMOUNT</td>
                                    <td rowspan="2">REMARKS</td>
                                </tr>
                                <tr>
                                    <td>QTY</td>
                                    <td>OFFICE / OFFICER</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($details as $item)
                                    <tr>
                                        <td>{{ date_format(date_create($item->created_at),"Y-m-d") }}</td>
                                        <td>{{ $item->po_no }}</td>
                                        <td>{{ $item->quantity_received }}</td>
                                        <td></td>
                                        <td align="center">{{ $item->office_name }}</td>
                                        <td></td>
                                        <td align="right" style="padding-right:25px;">{{ number_format($item->unit_cost,2) }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
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
