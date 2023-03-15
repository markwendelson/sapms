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
            <h4 class="mb-sm-0 font-size-18">Purchase Request</h4>

            {{-- <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                    <li class="breadcrumb-item active">Starter Page</li>
                </ol>
            </div> --}}

            <div class="page-title-right">
                {{-- {{route('purchase-request.edit', $pr->id)}} --}}
                @if(auth()->user()->hasDirectPermission('edit-purchase-request') && $pr->allow_edit)
                <a href="#" class="btn btn-info waves-effect waves-light">
                    <i class="bx bx-edit font-size-16 align-middle me-2"></i> Edit
                </a>
                @endif

                @if(auth()->user()->hasDirectPermission('delete-purchase-request'))
                <a href="#" class="btn btn-danger waves-effect waves-light">
                    <i class="bx bx-trash font-size-16 align-middle me-2"></i> Delete
                </a>
                @endif

                <a href="javascript:void(0)" onclick="printPage('{{route('reports.pr', ['id' => $pr->id])}}');" class="btn btn-primary waves-effect waves-light">
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
                                        <td style="width:100px">Department: </td>
                                        <td style="width: 270px;">{{$pr->office->name}}</td>
                                        <td style="width:75px">PR No.:</td>
                                        <td>{{$pr->pr_no}}</td>
                                        <td style="width:55px">Date:</td>
                                        <td style="padding-left:10px">{{date_format(date_create($pr->requested_at),"m/d/Y")}}</td>
                                    </tr>
                                    <tr>
                                        <td>Section: </td>
                                        <td>{{$pr->section}}</td>
                                        <td>SAI No.:</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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
                                        <td>TOTAL COST</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pr->details as $key => $item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$item->unit_of_measure}}</td>
                                            <td>
                                                <p class="mb-1">{{$item->item_name}}</p>
                                                <p>{{$item->item_description}}</p>
                                            </td>
                                            <td>{{$item->quantity}}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td>Total</td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="container mt-3">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Charges:</td>
                                        <td>{{$pr->charges_for}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:100px">Purpose/Remarks:</td>
                                        <td>{{$pr->purpose}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:100px">Requested By:</td>
                                        <td>{{$pr->requisitioner->name}}</td>
                                    </tr>
                                </tbody>
                            </table>
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
