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
            <h4 class="mb-sm-0 font-size-18">Items</h4>

            <div class="page-title-right">
                <a href="{{route('item.create')}}" class="btn btn-primary waves-effect waves-light">
                    <i class="bx bx-plus font-size-16 align-middle me-2"></i> Add new
                </a>
            </div>

        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                    <div class="card-body">

                        <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <td>Item Code</td>
                                    <td>Item Name</td>
                                    <td>Quantity</td>
                                    <td>U/M</td>
                                    {{-- <td>Actions</td> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                <tr>
                                    <td>
                                        <a href="{{route('item.show',$item)}}">{{$item->code}}</a>
                                    </td>
                                    <td>
                                        <h6>{{$item->name}}</h6>
                                        <ul class="list-group list-group-flush">
                                            @if(!empty($item->brand))
                                                <li class="list-group-item p-0">
                                                    <label>Brand:</label>
                                                    <span>{{$item->brand}}</span>
                                                </li>
                                            @endif

                                            @if(!empty($item->model))
                                            <li class="list-group-item p-0">
                                                <label>Model:</label>
                                                <span>{{$item->model}}</span>
                                            </li>
                                            @endif

                                            @if(!empty($item->serial_no))
                                            <li class="list-group-item p-0">
                                                <label>Serial No.:</label>
                                                <span>{{$item->serial_no}}</span>
                                            </li>
                                            @endif

                                        </ul>

                                    </td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->unit_of_measure}}</td>
                                    {{-- <td>
                                        <div class="button-items">
                                            <button type="button" class="btn btn-success waves-effect waves-light">
                                                <i class="bx bx-pencil font-size-16 align-middle me-2"></i> Edit
                                            </button>
                                            <button type="button" class="btn btn-danger waves-effect waves-light">
                                                <i class="bx bx-trash font-size-16 align-middle me-2"></i> Delete
                                            </button>
                                        </div>
                                    </td> --}}
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
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "aaSorting": []
            });
        });
    </script>
@endpush
