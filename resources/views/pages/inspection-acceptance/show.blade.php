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
            <h4 class="mb-sm-0 font-size-18">Inspection and Acceptance</h4>

            {{-- <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                    <li class="breadcrumb-item active">Starter Page</li>
                </ol>
            </div> --}}

            <div class="page-title-right">
                {{-- {{route('purchase-request.edit', $iar->id)}} --}}
                @if(auth()->user()->hasDirectPermission('edit-inspection-and-acceptance') && $iar->allow_edit)
                <a href="#" class="btn btn-info waves-effect waves-light">
                    <i class="bx bx-edit font-size-16 align-middle me-2"></i> Edit
                </a>
                @endif

                @if(auth()->user()->hasDirectPermission('delete-inspection-and-acceptance'))
                <a href="#" class="btn btn-danger waves-effect waves-light">
                    <i class="bx bx-trash font-size-16 align-middle me-2"></i> Delete
                </a>
                @endif

                @role('super-admin|admin')
                    @if($iar->allow_edit)
                    <a href="#" class="btn btn-info waves-effect waves-light">
                        <i class="bx bx-edit font-size-16 align-middle me-2"></i> Disable Editing
                    </a>
                    @else
                    <a href="#" class="btn btn-info waves-effect waves-light">
                        <i class="bx bx-edit font-size-16 align-middle me-2"></i> Enable Editing
                    </a>
                    @endif

                    @if($iar->allow_edit)
                    <a href="#" class="btn btn-info waves-effect waves-light">
                        <i class="bx bx-edit font-size-16 align-middle me-2" {{ $iar->allow_edit}}></i> Edit
                    </a>
                    @endif

                    <a href="#" class="btn btn-danger waves-effect waves-light">
                        <i class="bx bx-trash font-size-16 align-middle me-2"></i> Delete
                    </a>
                @endrole

                <a href="javascript:void(0)" onclick="printPage('{{route('reports.ia', ['id' => $iar->id])}}');" class="btn btn-primary waves-effect waves-light">
                    <i class="bx bx-printer font-size-16 align-middle me-2"></i> Print I.A
                </a>

                <a href="javascript:void(0)" onclick="printPage('{{route('reports.iar', ['id' => $iar->id])}}');" class="btn btn-primary waves-effect waves-light">
                    <i class="bx bx-printer font-size-16 align-middle me-2"></i> Print I.A.R
                </a>

                <a href="javascript:void(0)" onclick="printPage('{{route('reports.par', ['id' => $iar->id])}}');" class="btn btn-primary waves-effect waves-light">
                    <i class="bx bx-printer font-size-16 align-middle me-2"></i> Print P.A.R
                </a>

                <a href="javascript:void(0)" onclick="printPage('{{route('reports.ics', ['id' => $iar->id])}}');" class="btn btn-primary waves-effect waves-light">
                    <i class="bx bx-printer font-size-16 align-middle me-2"></i> Print I.C.S
                </a>
            </div>

        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="container">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td width="80px">Supplier:</td>
                                        <td width="60%">{{$iar->supplier_name}}</td>
                                        <td width="100px">IAR No.:</td>
                                        <td>{{ $iar->iar_no }}</td>
                                    </tr>
                                    <tr>
                                        <td>P.O No.:</td>
                                        <td>{{ $iar->purchase_order->po_no }}</td>
                                        <td>Invoice No.:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Department:</td>
                                        <td>{{ $iar->office->name }}</td>
                                        <td>Date:</td>
                                        <td>{{ date_format(date_create($iar->created_at),"m/d/Y") }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="container mt-3">
                            <table class="table table-responsive table-bordered">
                                <thead>
                                    <tr>
                                        <td>STOCK NO.</td>
                                        <td>UNIT</td>
                                        <td>ITEM AND DESCRIPTION</td>
                                        <td>QTY</td>
                                        <td>TYPE</td>
                                        <td>MODEL</td>
                                        <td>BRAND</td>
                                        <td>SERIAL NO.</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($iar->details as $key => $item)
                                        <tr>
                                            <td width="20px" align="center">{{$key+1}}</td>
                                            <td width="20px"></td>
                                            <td>
                                                <p class="mb-1">{{$item->item_name}}</p>
                                                <p>{{$item->item_description}}</p>
                                            </td>
                                            <td width="20px" align="center">{{floatval($item->quantity_received)}}</td>
                                            <td>{{$item->type}}</td>
                                            <td>{{$item->model}}</td>
                                            <td>{{$item->brand}}</td>
                                            <td>{{$item->serial_no}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>

                        <div class="container mt-3">

                        </div>

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
        $('#datatable').DataTable();
    });
</script>
@endpush
