@extends('layouts.v1')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Requisition and Issuance</h4>

            <div class="page-title-right">
                <a href="#" class="btn btn-primary waves-effect waves-light">
                    <i class="bx bx-plus font-size-16 align-middle me-2"></i> Edit
                </a>
                <a href="javascript:void()" onclick="printPage('{{route('reports.ris', ['id' => $requisition->id])}}')" class="btn btn-primary waves-effect waves-light">
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
                                        <td width="140px">Entity Name: </td>
                                        <td width="550px">{{$requisition->entity_name}}</td>
                                        <td>Fund Cluser:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Division: </td>
                                        <td>{{$requisition->division}}</td>
                                        <td>Responsibility Code:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Office</td>
                                        <td>{{$requisition->office->name}}</td>
                                        <td>RIS No.:</td>
                                        <td>{{$requisition->ris_no}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="container border-top">
                            <table class="table table-responsive table-bordered">
                                <thead>
                                    <tr>
                                        <td width="100px">STOCK NO.</td>
                                        <td>UNIT</td>
                                        <td>DESCRIPTION</td>
                                        <td>QUANTITY</td>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($requisition->details as $key => $item)
                                        <tr>
                                            <td></td>
                                            <td>{{$item->unit_of_measure}}</td>
                                            <td>
                                                <p class="mb-1">{{$item->item_description}}</p>
                                            </td>
                                            <td>{{$item->quantity}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        <div class="container border-top">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td width="140px">Requested By: </td>
                                        <td>{{$requisition->requisitioner->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Approved By: </td>
                                        <td>{{$requisition->approvedBy->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Issued By:</td>
                                        <td>{{$requisition->issuedBy->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Received By:</td>
                                        <td>{{$requisition->receivedBy->name}}</td>
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

@endpush
