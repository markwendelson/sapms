@extends('layouts.v1')

@push('extra_css')
<link href="{{ asset('/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
@endpush

@section('content')

<div class="row">
    <div class="col-12">

        <form action="{{route('purchase-order.store')}}" method="POST">
            @csrf
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Purchase Order</h4>
                <div class="d-flex flex-wrap gap-2" style="float:right">
                    <button type="submit" class="btn btn-primary waves-effect waves-light btn-save">
                        <i class="bx bx-save font-size-16 align-middle me-2"></i> Save
                    </button>
                    <a href="{{route('purchase-order.index')}}" class="btn btn-secondary waves-effect">
                        <i class="bx bx-x font-size-16 align-middle me-2"></i> Cancel
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body" id="purchase-order">

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-3 col-form-label">Supplier Name:</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="supplier_name" id="supplier_name" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-3 col-form-label">Supplier Address:</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="supplier_address" id="supplier_address" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-3 col-form-label">Place of Delivery:</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" value="" id="place_of_delivery" name="place_of_delivery" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-3 col-form-label">Date of Delivery:</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" value="" id="date_of_delivery" name="date_of_delivery" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-3 col-form-label">Delivery Time:</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" value="" id="delivery_time" name="delivery_time" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-3 col-form-label">Payment Term:</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" value="" id="payment_term" name="payment_term" required>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-4 col-form-label">PR Number:</label>
                                            <div class="col-md-8">
                                                <select class="select2 form-control" name="pr_id" id="pr_id" required>
                                                    <option value="" disabled selected>Select...</option>
                                                    @foreach ($prs as $pr)
                                                        <option value="{{$pr->id}}" {{ (old('pr_id') == $pr->id ? 'selected':'') }}>{{$pr->pr_no}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-4 col-form-label">PO Number:</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" value="{{$po_no}}" id="po_no" name="po_no" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-4 col-form-label">PO Date:</label>
                                            <div class="col-md-8">
                                                <div class="input-group" id="datepicker2">
                                                    <input type="text" class="form-control" name="po_date" id="po_date" placeholder="Select date"
                                                        data-date-format="yyyy-mm-dd" data-date-container='#datepicker2' data-provide="datepicker"
                                                        data-date-autoclose="true">

                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div><!-- input-group -->
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-4 col-form-label">Mode of Procurement:</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" value="" id="mode_of_procurement" name="mode_of_procurement" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <hr class="mb-3"> --}}

                                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                    <thead>
                                        <tr>
                                            <td>Stock No</td>
                                            <td>Unit</td>
                                            <td>Items and Description</td>
                                            <td>Quantity</td>
                                            <td>Unit Cost</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($po_items as $id => $item)
                                            <tr id="item-{{ $id }}">
                                                <td width="180px">
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
                                        @endforeach --}}
                                        <tr v-if="!{{count($po_items)}}">
                                            <td colspan="5">
                                                No matching records found.
                                            </td>
                                        </tr>
                                        <tr v-else :id="order.id" v-for="order in orders">
                                            {{-- <td width="180px">
                                                <a :href="{{route('item.show',order.id)}}">{{order.details.item.code}}</a>
                                            </td>
                                            <td>{{$item['item']['unit_of_measure']}}</td>
                                            <td>{{$item['item']['description']}}</td>
                                            <td>{{$item['quantity']}}</td>
                                            <td>
                                                <a href="javascript:void(0)">
                                                    <i data-id="{{ $id }}" class="bx bx-trash font-size-16 align-middle text-danger btn-remove"></i>
                                                </a>
                                            </td> --}}
                                        </tr>
                                    </tbody>
                                </table>

                                {{-- <hr class="mb-4"> --}}

                                {{-- <div class="row">
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
                                                    <label for="code" class="col-md-6 col-form-label">Quantity Ordered:</label>
                                                    <div class="col-md-6">
                                                        <input class="form-control" id="qty_ordered" type="text" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-wrap gap-2 mb-3" style="float:right">
                                            <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                <i class="bx bx-note font-size-16 align-middle me-2"></i> Get from PR
                                            </button>
                                            <button type="button" class="btn btn-info waves-effect waves-light btn-add">
                                                <i class="bx bx-plus font-size-16 align-middle me-2"></i> Add to List
                                            </button>
                                        </div>


                                    </div>
                                </div> --}}

                                {{-- <hr class="mb-4"> --}}




                        </div>
                    </div>
                </div>
            </div>
        </form>


        <!-- Static Backdrop Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Select PR...</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <thead>
                                <td>Date</td>
                                <td>PR Number</td>
                                <td></td>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')

<script src="{{asset('libs/select2/js/select2.min.js')}}"></script>
<script src="{{asset('libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script>

    $(".select2").select2();
    $('.btn-save').attr("disabled", true);

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
        let qty_ordered = $('#qty_ordered').val()

        if(item_id == '' || qty_ordered == '') {
            toastr["error"]('Please select an item and enter quantity.')
            return
        }

        const params = {
                item_id: item_id,
                qty_ordered: qty_ordered,
                entity_name: $('#entity_name').val(),
                division: $('#division').val(),
                office_id: $('#office_id').val(),
                purpose: $('#purpose').val(),
                responsibility_code: $('#responsibility_code').val(),
            };

        $.ajax({
            type: 'POST',
            url: `{{route('purchase-order.add')}}`,
            data: params,
            success: function(res) {
                window.location.reload()
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
            url: `{{route('purchase-order.remove')}}`,
            data: { id },
            success: function(response) {
                if (Object.keys(response.po_items).length <= 0) {
                    return window.location.reload();
                }

                $("#item-" + id).remove();
            },
            error: function (error) {
                toastr["error"](JSON.parse(error.responseText).message)
            }
        });
    })

    $('#po_date').datepicker('setDate', 'today');

    $('#pr_id').on('change',function (){
        const id = $(this).val();

        $.ajax({
            type: "GET",
            url: `/api/purchase-request/` + id,
            data: {},
            success: function(response) {

                console.log(response.details)

                let orders = response.details

                let markup = '';
                orders.forEach(o => {
                    if(o.item == null) {
                        markup += `<tr>
                                        <td width="180px"></td>
                                        <td>`+o.unit_of_measure+`</td>
                                        <td>`+o.item_description+`</td>
                                        <td>`+o.quantity+`</td>
                                        <td><input type="number" name=unit_cost[] class="form-control" required></td>
                                    </tr>`;
                    } else {
                        markup += `<tr>
                                        <td width="180px"><a href="/supplies/`+o.item.id+`" target="_blank">`+o.item.code+`</a></td>
                                        <td>`+o.item.unit_of_measure+`</td>
                                        <td>`+o.item_description+`</td>
                                        <td>`+o.quantity+`</td>
                                        <td><input type="number" name=unit_cost[] class="form-control" required></td>
                                    </tr>`;
                    }
                });

                tableBody = $("table tbody");
                tableBody.empty();
                tableBody.append(markup);
                $('.btn-save').removeAttr("disabled");
            },
            error: function (error) {
                toastr["error"](JSON.parse(error.responseText).message)
            }
        });
    })

</script>


@endpush
