@extends('layouts.v1')

@push('extra_css')
<link href="{{ asset('/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
@endpush

@section('content')

<div class="row">
    <div class="col-12">

        <form action="{{route('inspection-and-acceptance.store')}}" method="POST">
            @csrf

            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Inspection and Acceptance</h4>
                <div class="d-flex flex-wrap gap-2" style="float:right">
                    <button type="submit" class="btn btn-primary waves-effect waves-light btn-save">
                        <i class="bx bx-save font-size-16 align-middle me-2"></i> Save
                    </button>
                    <a href="{{route('inspection-and-acceptance.index')}}" class="btn btn-secondary waves-effect">
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
                                        <label for="supplier_name" class="col-md-3 col-form-label">Supplier Name:</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="supplier_name" id="supplier_name" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="po_id" class="col-md-3 col-form-label">PO Number:</label>
                                        <div class="col-md-9">
                                            <select class="select2 form-control" name="po_id" id="po_id" required>
                                                <option value="" disabled selected>Select...</option>
                                                @foreach ($pos as $po)
                                                    <option value="{{$po->id}}" {{ (old('po_id') == $po->id ? 'selected':'') }}>{{$po->po_no}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="department" class="col-md-3 col-form-label">Department:</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" id="department" name="department" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 row">
                                        <label for="po_no" class="col-md-4 col-form-label">IAR Number:</label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="text" value="{{$iar_no}}" id="iar_no" name="iar_no" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="invoice_no" class="col-md-4 col-form-label">Invoice No.::</label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="text" value="" id="invoice_no" name="invoice_no" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="datepicker2" class="col-md-4 col-form-label">Date:</label>
                                        <div class="col-md-8">
                                            <div class="input-group" id="datepicker2">
                                                <input type="text" class="form-control" name="iar_date" id="iar_date" placeholder="Select date"
                                                    data-date-format="yyyy-mm-dd" data-date-container='#datepicker2' data-provide="datepicker"
                                                    data-date-autoclose="true" required>

                                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                            </div><!-- input-group -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline">
                                <thead>
                                    <tr>
                                        <td style="width: 1%;text-align:center;">Stock No.</td>
                                        <td style="width: 1%;text-align:center">Unit</td>
                                        <td style="width: 30%;">Items and Description</td>
                                        <td >Quantity</td>
                                        <td>Type</td>
                                        <td>Model</td>
                                        <td>Brand</td>
                                        <td>Serial No</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="!{{count($iar_items)}}">
                                        <td colspan="8">
                                            No matching records found.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="datepicker2" class="col-md-4 col-form-label">Date Inspected:</label>
                                    <div class="col-md-8 mb-3">
                                        <div class="input-group" id="datepicker2">
                                            <input type="text" class="form-control" name="inspection_date" id="inspection_date" placeholder="Select date"
                                                data-date-format="yyyy-mm-dd" data-date-container='#datepicker2' data-provide="datepicker"
                                                data-date-autoclose="true" required>

                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div><!-- input-group -->
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-check">
                                            <input type="checkbox" name="inspected" id="inspected" class="form-check-input">
                                            <label class="form-check-label" for="inspected">Inspected, verified & found OK as to quantity & inspections</label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <label for="observation" class="col-md-4 col-form-label">Observation:</label>
                                        <textarea name="observation" id="observation" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="datepicker2" class="col-md-4 col-form-label">Date Received:</label>
                                    <div class="col-md-8">
                                        <div class="input-group" id="datepicker2">
                                            <input type="text" class="form-control" name="date_received" id="date_received" placeholder="Select date"
                                                data-date-format="yyyy-mm-dd" data-date-container='#datepicker2' data-provide="datepicker"
                                                data-date-autoclose="true" required>

                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div><!-- input-group -->
                                    </div>
                                    <div class="col-md-8">
                                        <label for="remarks_text" class="col-md-4 col-form-label">Remarks:</label>
                                        <div class="form-check">
                                            <input type="checkbox" name="complete" id="complete" class="form-check-input remarks-check" value="complete">
                                            <label class="form-check-label" for="complete">Complete</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="partial" id="partial" class="form-check-input remarks-check" value="partial">
                                            <label class="form-check-label" for="partial">Partial (pls. specify quantity)</label>
                                        </div>
                                        <textarea name="remarks_text" id="remarks_text" cols="30" rows="10" class="form-control mt-3"></textarea>
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

    $('#iar_date').datepicker('setDate', 'today');
    $('#inspection_date').datepicker('setDate', 'today');
    $('#date_received').datepicker('setDate', 'today');

    $('#po_id').on('change',function (){
        const id = $(this).val();

        $.ajax({
            type: "GET",
            url: `/api/purchase-order/` + id,
            data: {},
            success: function(response) {

                console.log(response)

                let order = response.details

                let markup = '';
                let i = 0;
                order.forEach(o => {
                    console.log(o)
                    i += 1;
                    if(o.item == null) {
                        markup += `<tr>
                                        <td width="180px">`+i+`</td>
                                        <td>`+o.unit_of_measure+`</td>
                                        <td><h6>`+o.item_name+`</h6><span>`+o.item_description+`</span></td>
                                        <td><input type="number" name=qty_received[] value="`+o.quantity+`" class="form-control" required></td>
                                        <td><input type="text" name="type[]" class="form-control"></td>
                                        <td><input type="text" name="model[]" class="form-control"></td>
                                        <td><input type="text" name="brand[]" class="form-control"></td>
                                        <td><input type="text" name="serial_no[]" class="form-control"></td>
                                    </tr>`;
                    } else {
                        markup += `<tr>
                                        <td width="180px">`+i+`</td>
                                        <td>`+o.unit_of_measure+`</td>
                                        <td><h6>`+o.item_name+`</h6><span>`+o.item.description+`</span></td>
                                        <td><input type="number" name=qty_received[] value="`+o.quantity+`" class="form-control" required></td>
                                        <td><input type="text" name="type[]" class="form-control"></td>
                                        <td><input type="text" name="model[]" class="form-control"></td>
                                        <td><input type="text" name="brand[]" class="form-control"></td>
                                        <td><input type="text" name="serial_no[]" class="form-control"></td>
                                    </tr>`;
                    }
                });

                tableBody = $("table tbody");
                tableBody.empty();
                tableBody.append(markup);

                console.log('supplier: '+response.supplier_name)
                $('#supplier_name').val(response.supplier_name)
                $('#department').val(response.office.name)
                $('.btn-save').removeAttr("disabled");
            },
            error: function (error) {
                toastr["error"](JSON.parse(error.responseText).message)
            }
        });
    })

    $(".remarks-check").on('change', function() {
        if($(this).is(':checked')) {
            $(".remarks-check").prop('checked',false);
            $(this).prop('checked',true);
        } else {
            $(this).prop('checked',false);
        }
    });

</script>


@endpush
