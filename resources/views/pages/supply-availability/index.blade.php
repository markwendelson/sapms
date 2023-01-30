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
            <h4 class="mb-sm-0 font-size-18">Supplies Availability Inquiry</h4>

        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <form id="form-search" class="row gy-2 gx-3 align-items-center" method="GET" route="{{route('supplies-availability-inquiry')}}}">
                            <div class="input-group">
                                <input type="text" class="form-control" id="search" name="search" value="{{request('search')}}" required>
                                <button class="btn btn-primary" id="btn-search" type="submit">Search</button>
                              </div>
                        </form>



                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                            <thead>
                                <tr>
                                    <td>Item Code</td>
                                    <td>Item name</td>
                                    <td>Quantity</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>
                                            <a href="{{route('item.show',$item->id)}}">{{$item->code}}</a>
                                        </td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->quantity.' '.$item->unit_of_measure}}</td>
                                    </tr>
                                @endforeach
                                <tr v-if="!{{count($items)}}">
                                    <td colspan="3">
                                        No matching records found
                                    </td>
                                </tr>
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
    {{-- <script src="/js/supplies-availability.js"></script> --}}
@endpush
