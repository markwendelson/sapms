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

    <div class="for_pr">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="page">
                    <div class="page-header-space"></div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 text-center pt-3" style="font-size: 15pt;">
                            <b>REQUISITION AND ISSUE SLIP</b>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-2">
                           Entity Name :
                        </div>
                        <div class="col-4 border-1 border-bottom">
                           {{$ris->entity_name}}
                        </div>
                        <div class="col-2">
                           FUND CLUSTER :
                        </div>
                        <div class="col-4 border-1 border-bottom" style="text-transform: uppercase;">
                            {{$ris->fund_cluster}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                           Division :
                        </div>
                        <div class="col-4 border-1 border-bottom">
                           {{$ris->division}}
                        </div>
                        <div class="col-3">
                           Resposibility Center Code:
                        </div>
                        <div class="col-3 border-1 border-bottom" style="text-transform: uppercase;">
                            {{$ris->responsibility_code}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                           Office :
                        </div>
                        <div class="col-4 border-1 border-bottom">
                           {{$ris->name}}
                        </div>
                        <div class="col-2">
                           RIS No.:
                        </div>
                        <div class="col-4 border-1 border-bottom" style="text-transform: uppercase;">
                            {{$ris->ris_no}}
                        </div>
                    </div>
                    <br>
                    <table class="table table-bordered m-0">
                        <thead class="text-center align-items-center">
                            <th width="10%" rowspan="2" colspan="4" width="10%" class="font-weight:bold;">REQUISITION</th>
                            <th width="10%" colspan="2">Stock Available?</th>
                            <th width="25%" colspan="2">Issue</th>
                        </thead>
                        <thead class="text-center align-items-center">
                           <th width="10%">Stock No.</th>
                           <th width="10%">Unit</th>
                           <th width="20%">Description</th>
                           <th width="10%">Quantity</th>
                           <th width="10%">Yes</th>
                           <th width="10%">No</th>
                           <th width="10%">Quantity</th>
                           <th width="15%">Remarks</th>
                        </thead>
                        <tbody>
                            @php $row = 1; @endphp
                            @foreach ($ris_details as $item)
                                <tr class="text-center">
                                    <td >{{$row}}</td>
                                    <td>{</td>
                                    <td>{!! $item->item_name.' - '.nl2br($item->item_description) !!}</td>
                                    <td>{{(int)$item->quantity}}</td>
                                </tr>
                                @php $row++;@endphp
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Fuel Consumption from February 22-28,2022.</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan = "8" class="text-center">
                                 ********** NOTHING FOLLOWS **********
                                </td>
                            </tr>
                            <tr>
                                <td colspan = "8">
                                 <b>Purpose:</b> {{$ris->purpose}}
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td width="25%">
                                    Requested By:
                                </td>
                                <td colspan = "2">
                                 Approved By:
                                </td>
                                <td colspan = "2">
                                 Issued By:
                                </td>
                                <td colspan = "2">
                                 Received By:
                                </td>
                            </tr>
                            <tr>
                                <td>Signature:</td>
                                <td width="25%">
                                </td>
                                <td colspan = "2">
                                </td>
                                <td colspan = "2">
                                </td>
                                <td colspan = "2">
                                </td>
                            </tr>
                            <tr>
                                <td>Printed Name:</td>
                                <td width="25%"><b>ENGR. JOSEPH B. LAGDAAN </b>
                                </td>
                                <td colspan = "2">ARIEL V. CUNA
                                </td>
                                <td colspan = "2">ALLAN M. CASILLANO
                                </td>
                                <td colspan = "2">
                                </td>
                            </tr>
                            <tr>
                                <td>Designation:</td>
                                <td width="25%"><b>CSWDMO </b>
                                </td>
                                <td colspan = "2">CGSO
                                </td>
                                <td colspan = "2">Supply and Property Inspection
                                </td>
                                <td colspan = "2">
                                </td>
                            </tr>
                            <tr>
                                <td>Date:</td>
                                <td width="25%">
                                </td>
                                <td colspan = "2">
                                </td>
                                <td colspan = "2">
                                </td>
                                <td colspan = "2">Section Head
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <div class="row p-0 m-0 ">
                        <div class="col-4 offset-8" style="font-weight:900;">
                           BONIFACIO S. BADILLO, JR.<br>
                           Member - Inspectorate Team
                           <br><br>
                           GABRIEL O.CABO<br>
                           Member - Inspectorate Team
                           <br><br>
                           GERTUDES B. CARDONA<br>
                           Member - Inspectorate Team
                           <br><br>
                           PERPECTA C. AMOYAN<br>
                           Member - Inspectorate Team
                           <br><br>
                           GINA M. CARGANDO<br>
                           Member - Inspectorate Team
                           <br><br>
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
