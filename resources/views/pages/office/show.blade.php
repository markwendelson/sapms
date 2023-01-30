@extends('layouts.v1')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Office</h4>

            <div class="page-title-right">
                <a href="{{route('office.edit', $office->id)}}" class="btn btn-primary waves-effect waves-light">
                    <i class="bx bx-pencil font-size-16 align-middle me-2"></i> Edit
                </a>
                <a href="{{route('office.index')}}" class="btn btn-secondary waves-effect waves-light">
                    <i class="bx bx-x font-size-16 align-middle me-2"></i> Back
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
                                <td width="15%">Office Code:</td>
                                <td>{{$office->code}}</td>
                            </tr>
                            <tr>
                                <td>Office Name:</td>
                                <td>{{$office->name}}</td>
                            </tr>
                            <tr>
                                <td>Officer in Charge:</td>
                                <td>{{$office->officer->name}}</td>
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
