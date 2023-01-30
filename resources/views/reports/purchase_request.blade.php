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
        <br><br><br><br><br><br><br><br>
    </div>

    <div class="for_pr">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="page">
                    <div class="page-header-space"></div>
                    <br>
                    <div class="row">
                        <div class="col-7">
                        </div>
                        <div class="col-3">
                            <b>Project Reference No.:</b>
                        </div>
                        <div class="col-2 border-1 border-bottom m-0 p-0">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                        </div>
                        <div class="col-3">
                            <b>Name of the Project:</b>
                        </div>
                        <div class="col-2 border-1 border-bottom">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                        </div>
                        <div class="col-3">
                            <b>Location of the Project:</b>
                        </div>
                        <div class="col-2 border-1 border-bottom">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center pt-3" style="font-size: 15pt;">
                            <b>PURCHASE REQUEST</b>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-2">
                            Department :
                        </div>
                        <div class="col-4 border-1 border-bottom">
                           {{$pr->name}}
                        </div>
                        <div class="col-1">
                            PR No.:
                        </div>
                        <div class="col-2 border-1 border-bottom">
                            {{$pr->pr_no}}
                        </div>
                        <div class="col-1">
                            Date:
                        </div>
                        <div class="col-2 border-1 border-bottom">
                            {{date('m/d/Y',strtotime($pr->requested_at))}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            Section :
                        </div>
                        <div class="col-3 border-1 border-bottom">
                            {{$pr->section}}
                        </div>
                        <div class="col-2 m-0">
                            SAI No.:
                        </div>
                        <div class="col-1 border-1 border-bottom">
                        </div>
                        <div class="col-1">
                        </div>
                        <div class="col-2">

                        </div>
                    </div>
                    <br>
                    <table class="table table-bordered m-0">
                        <thead class="text-center align-items-center">
                            <th width="10%">STOCK NO.</th>
                            <th width="10%">UNIT</th>
                            <th width="40%">ITEMS AND DESCRIPTION</th>
                            <th>QTY</th>
                            <th width="10%">UNIT COST</th>
                            <th width="10%">TOTAL COST</th>
                        </thead>
                        <tbody>
                            <tbody>
                                @php
                                    $row = 1;
                                    $total = 0;
                                    $limit = 48;
                                @endphp
                                 @foreach ($pr_details as $item)
                                    @php
                                    //$total += $item->quantit
                                    @endphp
                                     <tr class="text-center">
                                         <td >{{$row}}</td>
                                         <td>{{$item->unit_of_measure}}</td>
                                         <td>{!!$item->item_name.' - '.nl2br($item->item_description) !!}</td>
                                         <td>{{(int)$item->quantity}}</td>
                                         <td></td>
                                         <td></td>
                                     </tr>
                                     @php $row++;@endphp
                                 @endforeach
                                 <tr>
                                    <td colspan = "6" class="text-center">
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
                                    </tr>
                                 @endfor
                            <tr>
                                <td colspan = "4" class="text-center">
                                CHARGES: {{$pr->charges_for}}
                                </td>
                                <td><b>Total</b></td>
                                <td><b></b></td>
                            </tr>
                            <tr>
                                <td colspan = "6" class="text-left">
                                 <b>Purpose/Remarks:</b> For the conduct of Youth Sportfest Celebration featuring Larong Pinoy
                                </td>
                            </tr>
                            <tr>
                              <td colspan = "2"></td>
                              <td>Requested by:</td>
                              <td colspan = "3">Approved by:</td>
                            </tr>
                            <tr  style="height:50px;">
                              <td colspan="6" style="vertical-align:middle;">Signature:</td>
                            </tr>
                            <tr>
                              <td colspan="2">Printed Name:</td>
                              <td>THELMA F. BANAL</td>
                              <td colspan="3">HON. MARIA FE R. ABUNDA</td>
                            </tr>
                            <tr>
                              <td colspan="2">Designation:</td>
                              <td class="text-capitalize">City Social Welfare and Developement Officer</td>
                              <td colspan="3">City Mayor</td>
                            </tr>
                            <tr>
                              <td colspan="2">Date:</td>
                              <td colspan="4"></td>
                            </tr>
                        </tbody>
                    </table>
                  <br>
                    <div class="row p-0 m-0 ">
                        <div class="col-4 offset-8">
                           (Reference PR No.: <b>{{$pr->pr_no}}</b>)
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
