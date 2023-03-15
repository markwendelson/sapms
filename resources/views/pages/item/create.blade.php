@extends('layouts.v1')

@push('extra_css')
<link href="{{ asset('/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endpush

@section('content')

<div class="row">
    <div class="col-12">
        <form action="{{route('item.store')}}" method="POST" id="form">
            @csrf
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Add New Item</h4>
                <div class="d-flex flex-wrap gap-2" style="float:right">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                        <i class="bx bx-save font-size-16 align-middle me-2"></i> Save
                    </button>
                    <a href="{{route('item.index')}}" class="btn btn-secondary waves-effect">
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
                                    <div class="col-md-8">
                                        <div class="row">
                                            <label for="code" class="col-md-3 col-form-label">Type</label>
                                            <div class="col-md-9 mt-2">
                                                <input class="form-check-input" type="radio" name="type" id="semi-expendable" value="semi-expendable" checked>
                                                <label class="form-check-label" for="semi-expendable">Semi-expendable</label>
                                                <input class="form-check-input" type="radio" name="type" id="non-expendable" value="non-expendable">
                                                <label class="form-check-label" for="non-expendable">Non-expendable</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <label for="sub-type" class="col-md-4 col-form-label">Sub-type</label>
                                            <div class="col-md-8 mt-2">
                                                <input class="form-check-input sub-type" type="radio" name="sub-type" id="sphv" value="SPHV" checked>
                                                <label class="form-check-label" for="sphv">High Value</label>
                                                <input class="form-check-input sub-type" type="radio" name="sub-type" id="splv" value="SPLV">
                                                <label class="form-check-label" for="splv">Low value</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <div class="offset-4 d-flex gap-3 d-sm-flex" style="padding-left: 10px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{old('supplies')}}" id="supplies" name="supplies">
                                                <label class="form-check-label" for="supplies">Supplies</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{old('fixed_asset')}}" id="fixed_asset" name="fixed_asset">
                                                <label class="form-check-label" for="fixed_asset">Fixed Asset</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{old('biological_asset')}}" id="biological_asset" name="biological_asset">
                                                <label class="form-check-label" for="biological_asset">Biological Asset</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-4 col-form-label">Code</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" value="{{old('code') ?? $item_code}}" id="code" name="code" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 offset-md-2">
                                        <div class="mb-3 row">
                                            <label for="code" class="col-md-4 col-form-label">Date Acquired</label>
                                            <div class="col-md-8">
                                                <div class="input-group" id="datepicker2">
                                                    <input type="text" class="form-control" name="date_acquired" id="date_acquired" placeholder="Select date"
                                                        data-date-format="yyyy-mm-dd" data-date-container='#datepicker2' data-provide="datepicker"
                                                        data-date-autoclose="true">

                                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                                </div><!-- input-group -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="name" class="col-md-2 col-form-label">Name</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" value="{{old('name')}}" id="name" name="name" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="description" class="col-md-2 col-form-label">Description</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" type="text" id="description" name="description" required>{{old('description')}}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <div class="mb-3 row">
                                            <label for="quantity" class="col-md-4 col-form-label">Model</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" value="{{old('model')}}" id="model" name="model">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3 row">
                                            <label for="price" class="col-md-4 col-form-label">Brand</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" value="{{old('brand')}}" id="brand" name="brand">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3 row">
                                            <label for="price" class="col-md-4 col-form-label">Serial No.</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" value="{{old('serial_no')}}" id="serial_no" name="serial_no">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <div class="mb-3 row">
                                            <label for="quantity" class="col-md-4 col-form-label">Quantity</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="number" value="{{old('quantity')}}" id="quantity" name="quantity" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3 row">
                                            <label for="price" class="col-md-4 col-form-label">Price</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" value="{{old('price')}}" id="price" name="price" min="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3 row">
                                            <label for="price" class="col-md-4 col-form-label">Useful Life</label>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" value="{{old('useful_life')}}" id="useful_life" name="useful_life">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <div class="mb-3 row">
                                            <label for="unit_of_measure" class="col-md-4 col-form-label">Unit of Measure</label>
                                            <div class="col-md-8">
                                                <select class="select2 form-control" name="unit_of_measure" id="unit_of_measure" required>
                                                    <option value="" disabled selected>Select...</option>
                                                    @foreach (config('constants.unit_of_measure') as $unit_of_measure)
                                                        <option value="{{$unit_of_measure}}" {{ (old('unit_of_measure') == $unit_of_measure ? 'selected':'') }}>{{$unit_of_measure}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3 row">
                                            <label for="category" class="col-md-2 col-form-label">Category</label>
                                            <div class="col-md-10">
                                                <select class="select2 form-control" name="category" id="category" required>
                                                    <option value="" disabled selected>Select...</option>
                                                    @php
                                                        $categories = config('constants.category');
                                                        sort($categories);
                                                    @endphp
                                                    @foreach ($categories as $category)
                                                        <option value="{{$category}}" {{ (old('category') == $category ? 'selected':'') }}>{{$category}}</option>
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
<script src="{{asset('libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
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

    $('#date_acquired').datepicker();

    $( document ).ready( function () {
        $('#price').blur( function() {
            console.log($(this).val())
        })
    })

    $(".sub-type").on("change", function() {
        var oldText =  $("#code").val();
        var newText = oldText.split("=")
        var stringLength = newText[0].length;
        var returnValue = newText[0].substr(4, stringLength);
        var newCode = $(this).val() + returnValue;
        $("#code").val(newCode);
        if($(this).val() == 'SPLV') {
            $("#price").attr({
                "min" : 0,
                "max" : 49999
            });
        } else {
            $("#price").attr({
                "min" : 50000,
                "max" : 0
            });
        }
    })


    this.initItems()
    this.initBrands()
    this.initModels()


    function initItems()
    {
        $.ajax({
            type: "GET",
            url: `{{route('autocomplete-supplies')}}`,
            data: {},
            success: function(response) {
                $("#name").autocomplete({
                    source: response
                });
            },
            error: function (error) {
                toastr["error"](JSON.parse(error.responseText).message)
            }
        })
    }

    function initBrands()
    {
        $.ajax({
            type: "GET",
            url: `{{route('autocomplete-brands')}}`,
            data: {},
            success: function(response) {
                $("#brand").autocomplete({
                    source: response
                });
            },
            error: function (error) {
                toastr["error"](JSON.parse(error.responseText).message)
            }
        })
    }

    function initModels()
    {
        $.ajax({
            type: "GET",
            url: `{{route('autocomplete-models')}}`,
            data: {},
            success: function(response) {
                $("#model").autocomplete({
                    source: response
                });
            },
            error: function (error) {
                toastr["error"](JSON.parse(error.responseText).message)
            }
        })
    }


</script>
@endpush
