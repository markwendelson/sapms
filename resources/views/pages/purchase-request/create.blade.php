@extends('layouts.v1')

@push('extra_css')
<link href="{{ asset('/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
@endpush

@section('content')

<div class="row">
    <div class="col-12">

        <form action="{{route('purchase-request.store')}}" method="POST">
            @csrf
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Purchase Request</h4>
                <div class="page-title-right">
                    <button type="submit" class="btn btn-primary waves-effect waves-light btn-save">
                        <i class="bx bx-save font-size-16 align-middle me-2"></i> Save
                    </button>
                    <a href="{{route('purchase-request.index')}}" class="btn btn-secondary waves-effect">
                        <i class="bx bx-x font-size-16 align-middle me-2"></i> Cancel
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-3 col-form-label">Department:</label>
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
                                            <label for="code" class="col-md-3 col-form-label">Section:</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" value="" id="section" name="section" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-3 col-form-label">Purpose:</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" name="purpose" id="purpose" cols="30" rows="3"></textarea>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-4 col-form-label">PR Number:</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" value="{{$pr_no}}" id="pr_no" name="pr_no" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-4 col-form-label">Date:</label>
                                            <div class="col-md-8">
                                                <div class="input-group" id="datepicker2">
                                                    <input type="text" class="form-control" name="pr_date" id="pr_date" placeholder="Select date"
                                                        data-date-format="yyyy-mm-dd" data-date-container='#datepicker2' data-provide="datepicker"
                                                        data-date-autoclose="true">

                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div><!-- input-group -->
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-4 col-form-label">Charges:</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" value="" id="charges_for" name="charges_for" required>
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
                                            <td>Items and Description</td>
                                            <td>Quantity</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pr_items as $id => $item)
                                            <tr id="item-{{ $id }}">
                                                <td width="180px">
                                                    @if(is_int($item['item']['id']))
                                                        <a href="{{route('item.show',$item['item']['id'])}}">{{$item['item']['code']}}</a>
                                                    @endif
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
                                        <tr v-if="!{{count($pr_items)}}">
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
                                                    <label for="code" class="col-md-6 col-form-label">Quantity Requested:</label>
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

    var rowCount = $('table tbody tr').length;

    if(rowCount = 0) {
        $('.btn-save').attr("disabled", true);
    }

    $(".select2").select2({
        tags: true,
        createTag: function (params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }

            return {
                id: term,
                text: term,
                newTag: true // add additional parameters
            }
        }

    });

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
            error: function(data) {
                console.log(data.status)
                $("#description").val("");
                $("#description").prop("readonly",false);
                $("#unit_of_measure").val("");
                $("#unit_of_measure").prop("readonly",false);
                $('#quantity').val("")

            }
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
                item_id: item_id,
                qty_requested: qty_requested,
                entity_name: $('#entity_name').val(),
                division: $('#division').val(),
                office_id: $('#office_id').val(),
                purpose: $('#purpose').val(),
                responsibility_code: $('#responsibility_code').val(),
                description: $('#description').val(),
                unit_of_measure: $('#unit_of_measure').val(),
                qty_requested: $('#qty_requested').val(),
            };

        $.ajax({
            type: 'POST',
            url: `{{route('purchase-request.add')}}`,
            data: params,
            success: function(res) {
                // window.location.reload()
                console.log(res)

                var items = res.pr_items
                var markup = '';

                Object.entries(items).forEach(([key, value]) => {
                    var href = '#';
                    var item = value.item;
                    var code = '';

                    if(item.id !== null && Number.isInteger(item.id)) {
                        href = item.id
                        code = item.code
                    }

                    markup += `
                                <tr id="item-`+href+`">
                                    <td width="180px">
                                        <a href="/supplies/`+href+`">`+code+`</a>
                                    </td>
                                    <td>`+item.unit_of_measure+`</td>
                                    <td>`+item.description+`</td>
                                    <td>`+item.quantity+`</td>
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
            url: `{{route('purchase-request.remove')}}`,
            data: { id },
            success: function(response) {
                if (Object.keys(response.pr_items).length <= 0) {
                    return window.location.reload();
                }

                $("#item-" + id).remove();
            },
            error: function (error) {
                toastr["error"](JSON.parse(error.responseText).message)
            }
        });
    })

    $('#pr_date').datepicker('setDate', 'today');
</script>
@endpush
