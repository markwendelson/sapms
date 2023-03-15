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
        .for_pr{
            font-size: 8px !important;
        }

        .page-header, .page-header-space {
            height: 10px;
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
        .table_head_property_card{
            vertical-align:middle!important;
            text-align:center;
            font-weight:bold!important;
        }
        .par_signatory{
        font-size:14px;
        }
    </style>
</head>
<body>
    <div class="page-header">
        {{-- <div class="row">
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
        </div> --}}
        <div class="float-end">
            Appendix 59
        </div>
    </div>

    {{-- <div class="page-footer">
    {{ date('M d, Y H:i:s') }}
    </div> --}}

    <div class="for_pr">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="page">
                    <div class="page-header-space"></div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 text-center pt-3" style="font-size: 15pt;">
                            <b>INVENTORY CUSTODIAN SLIP</b>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-2">
                           Entity Name :
                        </div>
                        <div class="col-4 border-1 border-bottom">
                           LGU-BORONGAN
                        </div>
                        <div class="col-2">
                           ICS No. :
                        </div>
                        <div class="col-4 border-1 border-bottom" style="text-transform: uppercase;">
                            <b>2022-02-0145</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                           Fund Cluster :
                        </div>
                        <div class="col-4 border-1 border-bottom">
                        </div>
                    </div>
                    <br>
                    <table class="table table-bordered m-0">
                        <thead class="text-center align-items-center">
                            <tr>
                                <th width="10%" rowspan="2" width="10%">QTY</th>
                                <th width="10%" rowspan="2">UNIT</th>
                                <th width="25%" colspan="2">AMOUNT</th>
                                <th width="20%"rowspan="2">DESCRIPTION</th>
                                <th rowspan="2">DATE ACQUIRED</th>
                                <th width="10%" rowspan="2">INVENTORY ITEM NO.</th>
                                <th width="10%" rowspan="2">ESTIMATED USEFUL LIFE</th>
                            </tr>
                            <tr>
                                <th>Unit Cost</th>
                                <th>Total Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $row = 1;
                                $limit = 25;
                            @endphp
                            @foreach ($ia_details as $item)
                                <tr class="text-center">
                                    <td >{{(int)$item->quantity_received}}</td>
                                    <td>{{$item->unit_of_measure}}</td>
                                    <td>{{ number_format($item->unit_cost,2) }}</td>
                                    <td>{{number_format($item->unit_cost * $item->quantity_received,2)}}</td>
                                    <td>{{$item->item_description}}</td>
                                    <td>{{date('m/d/Y',strtotime($ia->date_received))}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @php $row++;@endphp
                            @endforeach
                            <tr>
                                <td colspan = "8" class="text-center">
                                 ********** NOTHING FOLLOWS **********
                                </td>
                            </tr>
                            @for ($i = $row; $i <= $limit; $i++)
                            <tr>
                                <td>&nbsp;</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endfor
                            <tr class="par_signatory">
                              <td colspan="4"><br>Received by:<br><br>
                                 <div class="text-center">
                                    <p>
                                        <u><b>PLTCOL  RUEL L. BURLAT</b></u>
                                        <br>Signature Over Printed Name
                                    </p>
                                    <p>
                                        <u><b>OIC Chief of Police</b></u>
                                        <br>(Position/Office)
                                    </p>

                                    <p style="border-top: solid 1px #000;margin-left: 25%;margin-right: 25%;">Date</p>
                                 </div>
                              </td>
                              <td colspan="4"><br>Issued by:<br><br>
                                 <div class="text-center">
                                    <p><u><b>BONIFACIO S. BADILLO, JR.</b></u>
                                    <br>Signature Over Printed Name
                                    </p>

                                    <p><u><b>Property Custodian</b></u>
                                    <br>Position/Office
                                    </p>

                                    <p style="border-top: solid 1px #000;margin-left: 25%;margin-right: 25%;">>Date</p>
                                 </div>
                              </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.report.scripts')
    @yield('scripts')
</body>

</html>
