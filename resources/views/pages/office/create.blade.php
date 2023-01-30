@extends('layouts.v1')

@push('extra_css')
<link href="{{ asset('/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')

<div class="row">
    <div class="col-12">
        <form action="{{route('office.store')}}" method="POST" id="form">
            @csrf
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Add New Office</h4>
                <div class="d-flex flex-wrap gap-2" style="float:right">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                        <i class="bx bx-save font-size-16 align-middle me-2"></i> Save
                    </button>
                    <a href="{{route('office.index')}}" class="btn btn-secondary waves-effect">
                        <i class="bx bx-x font-size-16 align-middle me-2"></i> Cancel
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">

                            @include('partials.errors')


                                <div class="mb-3 row">
                                    <label for="code" class="col-md-2 col-form-label">Code</label>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" value="{{old('code')}}" id="code" name="code" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="name" class="col-md-2 col-form-label">Name</label>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" value="{{old('name')}}" id="name" name="name" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-12">
                                        <div class="mb-3 row">
                                            <label for="officer_in_charge" class="col-md-2 col-form-label">Officer In Charge</label>
                                            <div class="col-md-6">
                                                <select class="select2 form-control" name="officer_in_charge" id="officer_in_charge" required>
                                                    <option value="" disabled selected>Select...</option>
                                                    @foreach ($officers_in_charge as $officer_in_charge)
                                                        <option value="{{$officer_in_charge->id}}" {{ (old('officer_in_charge') == $officer_in_charge->id ? 'selected':'') }}>{{$officer_in_charge->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('libs/select2/js/select2.min.js')}}"></script>
<script>
    $(".select2").select2();
</script>
@endpush
