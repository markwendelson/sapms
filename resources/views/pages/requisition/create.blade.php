@extends('layouts.v1')

@push('extra_css')
<link href="{{ asset('/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
@endpush

@section('content')

<div class="row">
    <div class="col-12">

        <form action="{{route('requisition-and-issuance.store')}}" method="POST">
            @csrf
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Requisition and Issuance</h4>
                <div class="d-flex flex-wrap gap-2" style="float:right">
                    <button type="submit" class="btn btn-primary waves-effect waves-light btn-save">
                        <i class="bx bx-save font-size-16 align-middle me-2"></i> Save
                    </button>
                    <a href="{{route('requisition-and-issuance.index')}}" class="btn btn-secondary waves-effect">
                        <i class="bx bx-x font-size-16 align-middle me-2"></i> Cancel
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-3 col-form-label">Entity Name:</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" value="" id="entity_name" name="entity_name" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-3 col-form-label">Division:</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" value="" id="division" name="division" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-3 col-form-label">Office:</label>
                                            <div class="col-md-9">
                                                <select class="select2 form-control" name="office_id" id="office_id" required>
                                                    <option value="" disabled selected>Select...</option>
                                                    @foreach ($offices as $office)
                                                        <option value="{{$office->id}}" {{ (old('office_id') == $office->id ? 'selected':'') }}>{{$office->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-3 col-form-label">Purpose:</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" name="purpose" id="purpose" cols="30" rows="3"></textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-6 col-form-label">Fund Cluster:</label>
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" value="" id="fund_cluser" name="fund_cluser">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-6 col-form-label">Responsibility Center Code:</label>
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" value="" id="responsibility_code" name="responsibility_code">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-6 col-form-label">RIS No.:</label>
                                            <div class="col-md-6">
                                                <input class="form-control" type="text" value="{{old('ris_no') ?? $ris_no}}" id="ris_no" name="ris_no" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-3 col-form-label">Date:</label>
                                            <div class="col-md-9">
                                                <div class="input-group" id="datepicker2">
                                                    <input type="text" class="form-control" name="ris_date" id="ris_date" placeholder="Select date"
                                                        data-date-format="yyyy-mm-dd" data-date-container='#datepicker2' data-provide="datepicker"
                                                        data-date-autoclose="true">

                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div><!-- input-group -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row border-top">
                                    <div class="col-md-6 pt-3">
                                        <div class="mb-3 row">
                                            <label for="requested_by" class="col-md-3 col-form-label">Requested By:</label>
                                            <div class="col-md-9">
                                                <select class="select2 form-control" name="requested_by" id="requested_by" required>
                                                    <option value="" disabled selected>Select...</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{$user->id}}" {{ (old('requested_by') == $user->id ? 'selected':'') }}>{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pt-3">
                                        <div class="mb-3 row">
                                            <label for="approved_by" class="col-md-3 col-form-label">Approved By:</label>
                                            <div class="col-md-9">
                                                <select class="select2 form-control" name="approved_by" id="approved_by" required>
                                                    <option value="" disabled selected>Select...</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{$user->id}}" {{ (old('approved_by') == $user->id ? 'selected':'') }}>{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3 row">
                                            <label for="issued_by" class="col-md-3 col-form-label">Issued By:</label>
                                            <div class="col-md-9">
                                                <select class="select2 form-control" name="issued_by" id="issued_by" required>
                                                    <option value="" disabled selected>Select...</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{$user->id}}" {{ (old('issued_by') == $user->id ? 'selected':'') }}>{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3 row">
                                            <label for="received_by" class="col-md-3 col-form-label">Received By:</label>
                                            <div class="col-md-9">
                                                <select class="select2 form-control" name="received_by" id="received_by" required>
                                                    <option value="" disabled selected>Select...</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{$user->id}}" {{ (old('received_by') == $user->id ? 'selected':'') }}>{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="mb-3">

                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                    <thead>
                                        <tr>
                                            <td>Stock No</td>
                                            <td>Unit</td>
                                            <td>Description</td>
                                            <td>Quantity</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($requisition_items as $id => $item)
                                            <tr id="item-{{ $id }}">
                                                <td>
                                                    <a href="{{route('item.show',$item['item']['id'])}}">{{$item['item']['code']}}</a>
                                                </td>
                                                <td>{{$item['item']['unit_of_measure']}}</td>
                                                <td>{{$item['item']['description']}}</td>
                                                <td>{{$item['quantity']}}</td>
                                                <td>
                                                    <a href="javascript:void(0)">
                                                        <i data-id="{{ $id }}" class="bx bx-trash font-size-16 align-middle text-danger btn-remove"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr v-if="!{{count($requisition_items)}}">
                                            <td colspan="5">
                                                No matching records found.
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <hr class="mb-4">


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-2 col-form-label">Item:</label>
                                            <div class="col-md-10">
                                                <select class="select2 form-control" name="item" id="item">
                                                    <option value="" disabled selected>Select item to add... </option>
                                                    @foreach ($items as $item)
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-2 col-form-label">Description:</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" id="description" cols="30" rows="5" readonly></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3 row">
                                                    <label for="code" class="col-md-6 col-form-label">Unit:</label>
                                                    <div class="col-md-6">
                                                        <input class="form-control" id="unit_of_measure" type="text" value="" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3 row">
                                                    <label for="code" class="col-md-5 col-form-label">Available Quantity:</label>
                                                    <div class="col-md-6">
                                                        <input class="form-control" id="quantity" type="text" value="" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3 row">
                                                    <label for="code" class="col-md-6 col-form-label">Quantity Request:</label>
                                                    <div class="col-md-6">
                                                        <input class="form-control" id="qty_requested" type="text" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-wrap gap-2 mb-3" style="float:right">
                                            <button type="button" class="btn btn-info waves-effect waves-light btn-add">
                                                <i class="bx bx-plus font-size-16 align-middle me-2"></i> Add to List
                                            </button>
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
<script src="{{asset('libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script>

    $(".select2").select2();
    $('#ris_date').datepicker('setDate', 'today');

    var rowCount = {{count($requisition_items)}};

    if(rowCount == 0) {
        $('.btn-save').attr("disabled", true);
    }

    $('#item').on('change', function() {
        let item_id = $('#item').val();
        $.ajax({
            type: 'GET',
            url: '/api/item/' + item_id,
            dataType: "json",
            success: function(data){
                $('#description').val(data.description)
                $('#unit_of_measure').val(data.unit_of_measure)
                $('#quantity').val(data.quantity)
            },
        })
    })

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    $('.btn-add').on('click', function() {
        let item_id = $('#item').val()
        let qty_requested = $('#qty_requested').val()

        if(item_id == '' || qty_requested == '') {
            toastr["error"]('Please select an item and enter quantity.')
            return
        }

        const params = {
                item_id: $('#item').val(),
                qty_requested: $('#qty_requested').val(),
            };

        $.ajax({
            type: 'POST',
            url: `{{route('requisition.add')}}`,
            data: params,
            success: function(res) {
                var items = res.requisition_items
                var markup = '';

                Object.entries(items).forEach(([key, value]) => {
                    var item = value.item;
                    console.log(item)
                    markup += `
                                <tr id="item-`+item.id+`">
                                    <td width="180px">
                                        <a href="/supplies/`+item.id+`">`+item.code+`</a>
                                    </td>
                                    <td>`+item.unit_of_measure+`</td>
                                    <td>`+item.description+`</td>
                                    <td>`+value.quantity+`</td>
                                    <td>
                                        <a href="javascript:void(0)">
                                            <i data-id="`+item.id+`" class="bx bx-trash font-size-16 align-middle text-danger btn-remove"></i>
                                        </a>
                                    </td>
                                </tr>
                            `;
                })

                tableBody = $("table tbody");
                tableBody.empty();
                tableBody.append(markup);
                $('.btn-save').removeAttr("disabled");
            },
            error: function(error) {
                toastr["error"](JSON.parse(error.responseText).message)
            },
        })
    })

    $('.btn-remove').on('click', function() {
        const id = $(this).attr("data-id");

        $.ajax({
            type: "DELETE",
            url: `{{route('requisition.remove')}}`,
            data: { id },
            success: function(response) {
                if (Object.keys(response.requisition_items).length <= 0) {
                    return window.location.reload();
                }

                $("#item-" + id).remove();
            },
            error: function (error) {
                toastr["error"](JSON.parse(error.responseText).message)
            }
        });
    })
</script>
@endpush
