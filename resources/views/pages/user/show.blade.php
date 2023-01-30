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
            <h4 class="mb-sm-0 font-size-18">User - {{$user->name}}</h4>
            <div class="page-title-right">
                <form class="d-inline-block" action="{{route('user.reset-password', ['id'=>$user->id])}}" method="POST" id="form">
                    @csrf
                    @method('PUT')

                    <button type="submit" class="btn btn-warning waves-effect waves-light">
                        <i class="bx bx-lock font-size-16 align-middle me-2"></i> Reset Password
                    </button>
                </form>
                <a href="{{route('user.edit', $user->id)}}" class="btn btn-primary waves-effect waves-light">
                    <i class="bx bx-pencil font-size-16 align-middle me-2"></i> Edit
                </a>
                <a href="{{route('user.index')}}" class="btn btn-secondary waves-effect waves-light">
                    <i class="bx bx-x font-size-16 align-middle me-2"></i> Back
                </a>
            </div>
        </div>

        @include('partials.message')

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        <div class="mb-3">
                            <label for="office">Office:</label>
                            <input type="text" class="form-control" disabled value="{{$user->office?->name }}">
                        </div>

                        <hr>
                        <div class="mb-3">
                            <label for="office">Role(s):</label>
                            <ul class="list-group list-group-horizontal">
                                @foreach ($user->roles as $role)
                                    <li class="list-group-item text-capitalize me-2">{{str_replace("-"," ",$role->name)}}</li>
                                @endforeach
                            </ul>

                        </div>

                        <hr>
                        <div class="mb-3">
                            <form action="{{route('user.update-permissions',['id'=>$user->id])}}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <label for="permissions">Permissions</label>
                                    <div class="page-title-right">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            <i class="bx bx-save font-size-16 align-middle me-2"></i> Update
                                        </button>
                                    </div>
                                </div>

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <td>Module</td>
                                            <td>Can View</td>
                                            <td>Can Create</td>
                                            <td>Can Edit</td>
                                            <td>Can Delete</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user_modules as $module)
                                            {{-- @php
                                                dd($module);
                                            @endphp --}}
                                            <tr>
                                                <td>{{$module['name']}}</td>
                                                <td align="center">
                                                    <input type="checkbox" class="permissions" name='permissions[{{$module['view']['name']}}]'  {{$module['view']['value'] ? 'checked' : ''}}>
                                                </td>
                                                <td align="center">
                                                    <input type="checkbox" class="permissions" name='permissions[{{$module['create']['name']}}]' {{$module['create']['value'] ? 'checked' : ''}}>
                                                </td>
                                                <td align="center">
                                                    <input type="checkbox" class="permissions" name='permissions[{{$module['edit']['name']}}]' {{$module['edit']['value'] ? 'checked' : ''}}>
                                                </td>
                                                <td align="center">
                                                    <input type="checkbox" class="permissions" name='permissions[{{$module['delete']['name']}}]' {{$module['delete']['value'] ? 'checked' : ''}}>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
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

        $(".permissions").on("change", function() {
            var o = $(this);
            get(o);
        })

        function get(o) {
            ( $(o).val() == 0 ) ? $(o).val(1) : $(o).val(0);

            console.log( $(o).val() );
        };
    });
</script>
@endpush
