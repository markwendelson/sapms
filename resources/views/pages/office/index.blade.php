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
            <h4 class="mb-sm-0 font-size-18">Offices</h4>

            <div class="page-title-right">
                <a href="{{route('office.create')}}" class="btn btn-primary waves-effect waves-light">
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
                                    <td>Code</td>
                                    <td>Name</td>
                                    <td>Officer-in-Charge</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($offices as $office)
                                <tr>
                                    <td>
                                        <a href="{{route('office.show',$office)}}">{{$office->code}}</a>
                                    </td>
                                    <td>{{$office->name}}</td>
                                    <td>{{$office->officer->name}}</td>
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
            $('#datatable').DataTable();
        });
    </script>
@endpush
