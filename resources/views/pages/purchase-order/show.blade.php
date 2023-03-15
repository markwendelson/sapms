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
            <h4 class="mb-sm-0 font-size-18">Purchase Order</h4>

            {{-- <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                    <li class="breadcrumb-item active">Starter Page</li>
                </ol>
            </div> --}}

            <div class="page-title-right">
                {{-- {{route('purchase-request.edit', $po->id)}} --}}
                @if(auth()->user()->hasDirectPermission('edit-purchase-order') && $po->allow_edit)
                <a href="#" class="btn btn-info waves-effect waves-light">
                    <i class="bx bx-edit font-size-16 align-middle me-2"></i> Edit
                </a>
                @endif

                @if(auth()->user()->hasDirectPermission('delete-purchase-order'))
                    <a href="#" class="btn btn-danger waves-effect waves-light">
                        <i class="bx bx-trash font-size-16 align-middle me-2"></i> Delete
                    </a>
                @endif

                @role('super-admin|admin')
                    @if($po->allow_edit)
                    <a href="#" class="btn btn-info waves-effect waves-light">
                        <i class="bx bx-edit font-size-16 align-middle me-2"></i> Disable Editing
                    </a>
                    @else
                    <a href="#" class="btn btn-info waves-effect waves-light">
                        <i class="bx bx-edit font-size-16 align-middle me-2"></i> Enable Editing
                    </a>
                    @endif

                    @if($po->allow_edit)
                    <a href="#" class="btn btn-info waves-effect waves-light">
                        <i class="bx bx-edit font-size-16 align-middle me-2" {{ $po->allow_edit}}></i> Edit
                    </a>
                    @endif

                    <a href="#" class="btn btn-danger waves-effect waves-light">
                        <i class="bx bx-trash font-size-16 align-middle me-2"></i> Delete
                    </a>
                @endrole

                <a href="javascript:void(0)" onclick="printPage('{{route('reports.po', ['id' => $po->id])}}');" class="btn btn-primary waves-effect waves-light">
                    <i class="bx bx-printer font-size-16 align-middle me-2"></i> Print
                </a>
            </div>

        </div>

        @include('partials.message')

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <div class="container">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td style="width:700px" rowspan="2">Supplier: <br> {{$po->supplier_name}}</td>
                                        <td colspan="2">PO No.: {{$po->po_no}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Date: {{date_format(date_create($po->created_at),"m/d/Y")}}</td>
                                    </tr>
                                    <tr>
                                        <td>Address: {{$po->supplier_address}}</td>
                                        <td>Modem of Procurement: {{$po->mode_of_procurement}}</td>
                                        <td>Section: A</td>
                                    </tr>
                                    <tr>
                                        <td>Place of Delivery: {{$po->place_of_delivery}}</td>
                                        <td>Delivery Time: {{$po->delivery_time}}</td>
                                    </tr>
                                    <tr>
                                        <td>Date of Delivery: {{$po->date_of_delivery}}</td>
                                        <td>Payment Term: {{$po->payment_term}}</td>
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
                                        <td>UNIT COST</td>
                                        <td>AMOUNT</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($po->details as $key => $item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$item->unit_of_measure}}</td>
                                            <td>
                                                <p class="mb-1">{{$item->item_name}}</p>
                                                <p>{{$item->item_description}}</p>
                                            </td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{number_format($item->unit_cost,2)}}</td>
                                            <td>{{number_format(($item->quantity * $item->unit_cost),2)}}</td>
                                            @php
                                            $total += $item->quantity * $item->unit_cost;
                                            @endphp
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td>Total</td>
                                        <td>{{number_format($total,2)}}</td>
                                    </tr>
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
