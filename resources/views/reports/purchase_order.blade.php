<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('layouts.report.meta')
    @yield('meta')

    @include('layouts.report.css')
    @yield('css')
    <style type="text/css">
        body {
            font-family: courier;
            font-size: 10pt;
            background: white;
        }
        .rpt-title {
            font-size: 16pt;
            letter-spacing: 2px;
            font-weight: 600;
        }
        th {
            vertical-align: top;

        }
        td {
            padding-top: 0px !important;
            padding-bottom: 0px !important;

            font-size: 7px;
            vertical-align: top;
            max-width: 100px; /*or whatever*/
            word-wrap: break-word;
        }
        .for_inspection{
            font-size: 8px !important;
        }

        .page-header, .page-header-space {
            height: 80px;
          }

          .page-footer, .page-footer-space {
          }

          .page-header {
            display: none;
          }

          .page-footer {
            display: none;
          }

          .centered-address{
            display: none;
          }

          .centered-contact{
            display: none;
          }



        @media print {
            thead {display: table-header-group;}
            tfoot {display: table-footer-group;}

            .page-footer {
                display: block;
                position: fixed;
                bottom: 0;
                width: 100%;
            }

            .page-header {
                display: block;
                position: fixed;
                top: 0;
                width: 100%;
            }

            .centered-address {
                display: inline-block;
                position: absolute;
                top: 23%;
                left: 60%;
                font-size: 12px;
                text-align: right;
                font-style: Gotham Book !important;
            }

            .centered-contact {
                display: inline-block;
                position: absolute;
                left:81%;
                font-size: 12px;
                font-style: Gotham Book !important;
                text-align: left;
            }

            #hide_when_print{
                display: none;
            }

            body {margin: 0;}

            .page {
                page-break-after: always !important;;
                width: 100%;
            }

        }

        .underline {
            border-bottom: 1px solid #000;
        }


        .nextpage {
            page-break-after:always !important;
        }

        .border-bottom-black { border-bottom: 1px solid black; }
    </style>
</head>
<body>
    <div class="page-header">
        <div class="row">
            <div class="col-4">
                <img src="{{ asset('images/logo-borongan.jpg') }}" style="height:70px;float:right"/>
            </div>
            <div class="col-4 text-center">
                Republic of the Philippines <br>
                City Government of Borongan<br>
                Province of Eastern Samar <br>
                <b>CITY GENERAL SERVICES OFFICE</b>
            </div>
             <div class="col-4 text-left">
                <img src="{{ asset('images/logo-da.jpeg') }}" style="height:70px"/>
            </div>
        </div>
    </div>

    <div class="page-footer">
    </div>

    <div>
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="page for_inspection">
                    <div class="page-header-space">

                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center pt-3" style="font-size: 15pt;">
                            <b>PURCHASE ORDER</b>
                        </div>
                    </div>
                    <br><br>
                    <div class="row p-0 m-0  ">
                        <div class="col-8 text-center border ">
                            <div class="row pt-2">
                                <div class="col-1">
                                    Supplier:
                                </div>
                                <div class="col-9">
                                    {{$po->supplier_name}}
                                </div>
                            </div>
                            <br><br>
                            <div class="row pb-2">
                                <div class="col-1">
                                    Address:
                                </div>
                                <div class="col-9">
                                    {{$po->supplier_address}}
                                </div>
                            </div>
                        </div>
                        <div class="col-4 border">
                           <div class="row px-2 border-1 border-bottom">
                               P.O No. : {{$po->po_no}}
                           </div>
                           <div class="row px-2 border-1 border-bottom">
                               Date: {{date('m/d/Y',strtotime($po->created_at))}}
                           </div>
                           <div class="row px-2 " >
                                <div class="col-6 ">
                                    Mode of Procurement
                                </div>
                                <div class="col-6 ">
                                    {{$po->mode_of_procurement}}
                                </div>
                           </div>
                        </div>
                    </div>
                    <div class="row py-3 p-0 m-0 border ">
                        <div class="col-1">
                            Gentlemen:
                        </div>
                        <div class="col-10 text-center">
                            Please furnish this office the following articles subject to the terms and conditions contained herein.
                        </div>
                    </div>
                    <div class="row p-0 m-0 ">
                        <div class="col-8 border py-1 ">
                            <div class="row">
                                <div class="col-3">
                                    Place of Delivery:
                                </div>
                                <div class="col-9 text-center">
                                    {{$po->place_of_delivery}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    Date of Delivery:
                                </div>
                                <div class="col-9 text-center">
                                    {{$po->date_of_delivery}}
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-center border  ">
                            <div class="row ">
                                <div class="col-5">
                                    Delivery Time:
                                </div>
                                <div class="col-6 offset-1 text-center border-1 border-bottom">
                                    {{$po->delivery_time}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    Payment Term:
                                </div>
                                <div class="col-6 offset-1 text-center border-1 border-bottom">
                                    {{$po->payment_term}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered m-0">
                        <thead class="text-center">
                            <th width="5%">STOCK NO.</th>
                            <th width="5%">UNIT</th>
                            <th width="50%">ITEMS AND DESCRIPTION</th>
                            <th>QTY</th>
                            <th>UNIT COST</th>
                            <th>AMOUNT</th>
                        </thead>
                        <tbody>
                            @php
                            $row = 1;
                            $total = 0;
                            $limit = 30;
                            @endphp
                            @foreach ($po_details as $item)
                                @php
                                    $total += $item->quantity * $item->unit_cost;
                                @endphp
                                <tr class="text-center">
                                    <td >{{$row}}</td>
                                    <td>{{$item->unit_of_measure}}</td>
                                    <td>{!! $item->item_name.' - '.nl2br($item->item_description) !!}</td>
                                    <td>{{(int)$item->quantity}}</td>
                                    <td>{{number_format($item->unit_cost,2)}}</td>
                                    <td></td>
                                </tr>
                                @php $row++;@endphp
                            @endforeach
                            @for ($i = $row; $i <= $limit; $i++)
                            <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endfor
                            <tr style="line-height: 30px;" class="text-center">
                                <td colspan="2">TOTAL AMOUNT IN WORDS</td>
                                <td colspan="3">{{ \App\Http\Controllers\ReportController::convert_number_to_words($total) }}</td>
                                <td>₱{{number_format($total,2)}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row py-3 p-0 m-0 border ">
                        <div class="row">
                            <div class="col-9">
                                &emsp;&emsp;&emsp;&emsp; In case of failure to make the full delivery within the time specified above, a penalty of one-tenth(1/10) of one percent for everyday of delay shall be imposed.
                            </div>
                        </div>
                        <div class="row py-1">
                            <div class="col-3 offset-7">
                               Very truly yours,
                            </div>
                        </div>
                        <div class="row pt-2 text-center">
                            <div class="col-4 offset-8 border-1 border-bottom">
                                    JOSE IVAN DAYAN C. AGDA
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-4 offset-8 ">
                                    CITY MAYOR
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 ">
                                Conforme:
                            </div>
                        </div>
                        <div class="row pt-2 text-center">
                            <div class="col-4 offset-1  border-1 border-bottom">
                                 MS. CHRISTINA C. CABAGUING
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-4 offset-1 ">
                                 Signature over Printed Name of Supplier
                            </div>
                        </div>
                        <div class="row pt-3 text-center">
                            <div class="col-2 offset-2  border-1 border-bottom">

                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-4 offset-1 ">
                                Date
                            </div>
                        </div>
                    </div>
                    <div class="row p-0 m-0  ">
                        <div class="col-7 border">
                            <div class="row">
                                Funds Available:
                            </div>
                            <div class="row text-center">
                                <div class="offset-3 col-9 border-1 border-bottom">
                                    DIANE B. CINCO
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="offset-3 col-9">
                                    City Accountant
                                </div>
                            </div>
                        </div>
                        <div class="col-5 border">
                            <div class="row">
                                <div class="col-4">
                                    ALOBS No. :
                                </div>
                                <div class="col-8 border-1 border-bottom">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    Amount :
                                </div>
                                <div class="col-8 border-1 border-bottom">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.report.scripts')
    @yield('scripts')
</body>

</html>
