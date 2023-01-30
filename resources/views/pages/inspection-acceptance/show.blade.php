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
                <a href="#" class="btn btn-info waves-effect waves-light">
                    <i class="bx bx-edit font-size-16 align-middle me-2"></i> Edit
                </a>
                <a href="#" class="btn btn-danger waves-effect waves-light">
                    <i class="bx bx-trash font-size-16 align-middle me-2"></i> Delete
                </a>
                <a href="javascript:void(0)" onclick="printPage('{{route('reports.ia', ['id' => $iar->id])}}');" class="btn btn-primary waves-effect waves-light">
                    <i class="bx bx-printer font-size-16 align-middle me-2"></i> Print I.A
                </a>

                <a href="javascript:void(0)" onclick="printPage('{{route('reports.iar', ['id' => $iar->id])}}');" class="btn btn-primary waves-effect waves-light">
                    <i class="bx bx-printer font-size-16 align-middle me-2"></i> Print I.A.R
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
                                        <td style="width:700px" rowspan="2">Supplier: <br> {{$iar->supplier_name}}</td>
                                        <td colspan="2">PO No.: {{$iar->po_no}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Date: {{date_format(date_create($iar->created_at),"m/d/Y")}}</td>
                                    </tr>
                                    <tr>
                                        <td>Address: {{$iar->supplier_address}}</td>
                                        <td>Modem of Procurement: {{$iar->mode_of_procurement}}</td>
                                        <td>Section: A</td>
                                    </tr>
                                    <tr>
                                        <td>Place of Delivery: {{$iar->place_of_delivery}}</td>
                                        <td>Delivery Time: {{$iar->delivery_time}}</td>
                                    </tr>
                                    <tr>
                                        <td>Date of Delivery: {{$iar->date_of_delivery}}</td>
                                        <td>Payment Term: {{$iar->payment_term}}</td>
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
                                    @foreach ($iar->details as $key => $item)
                                        <tr>
                                            <td width="20px" align="center">{{$key+1}}</td>
                                            <td width="20px"></td>
                                            <td>
                                                <p class="mb-1">{{$item->item_name}}</p>
                                                <p>{{$item->item_description}}</p>
                                            </td>
                                            <td width="20px" align="center">{{floatval($item->quantity_received)}}</td>
                                            <td width="20px" align="right">{{number_format($item->unit_cost,2)}}</td>
                                            <td width="20px" align="right">{{number_format(($item->quantity_received * $item->unit_cost),2)}}</td>
                                            @php
                                            $total += $item->quantity_received * $item->unit_cost;
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
