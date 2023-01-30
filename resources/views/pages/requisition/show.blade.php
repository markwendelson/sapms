@extends('layouts.v1')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Requisition and Issuance</h4>

            <div class="page-title-right">
                <a href="{{route('requisition-and-issuance.edit', 1)}}" class="btn btn-primary waves-effect waves-light">
                    <i class="bx bx-plus font-size-16 align-middle me-2"></i> Edit
                </a>
                <a href="{{route('requisition-and-issuance.edit', 1)}}" class="btn btn-primary waves-effect waves-light">
                    <i class="bx bx-printer font-size-16 align-middle me-2"></i> Print
                </a>
            </div>

        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')

@endpush
