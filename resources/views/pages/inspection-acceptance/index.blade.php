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

            <div class="page-title-right">
                <a href="{{route('inspection-and-acceptance.create')}}" class="btn btn-primary waves-effect waves-light">
                    <i class="bx bx-plus font-size-16 align-middle me-2"></i> Add new
                </a>
            </div>

        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                            <thead>
                                <tr>
                                    <td>Date</td>
                                    <td>IAR Number</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($iar as $item)
                                    <tr>
                                        <td>{{date_format(date_create($item->created_at),"Y-m-d")}}</td>
                                        <td>
                                            <a href="{{route('inspection-and-acceptance.show',$item->id)}}">{{$item->iar_no}}</a>
                                        </td>
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
