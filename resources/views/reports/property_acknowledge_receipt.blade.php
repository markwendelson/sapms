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
                            <b>PROPERTY ACKNOWLEDGEMENT RECEIPT</b>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-2" style="width:90px;">
                           Entity Name  :
                        </div>
                        <div class="col-4 border-1 border-bottom px-1">
                           City Social Welfare & Developement Office
                        </div>
                        <div class="col-2" style="text-align: right;margin-left:150px;">
                            PAR No.:
                        </div>
                        <div class="col-1 border-1 border-bottom" style="text-transform: uppercase;">
                            <b>20-0246</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2" style="width:90px;">
                           Fund Cluster:
                        </div>
                        <div class="col-4 border-1 border-bottom px-1">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-2" style="width:90px;">
                           Ref PIS No. :
                        </div>
                        <div class="col-1 border-1 border-bottom">
                           <b>20-291</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2" style="width:90px;padding-left:3.9em;">
                           PRS No. :
                        </div>
                        <div class="col-1 border-1 border-bottom px=1">
                        </div>
                    </div>
                    <br>
                    <table class="table table-bordered m-0">
                        <thead class="text-center align-items-center">
                            <th width="10%">QTY</th>
                            <th width="10%">UNIT</th>
                            <th width="15%">DESCRIPTION</th>
                            <th width="10%">PROPERTY NUMBER</th>
                            <th width="10%">DATE ACQUIRED</th>
                            <th width="10%">AMOUNT</th>
                        </thead>
                        <tbody>
                            @php
                                $row = 1;
                                $limit = 10;
                            @endphp
                            @foreach ($ia_details as $item)
                            <tr class="text-center">
                                <td>{{$row}}</td>
                                <td>{{$item->unit_of_measure}}</td>
                                <td align="left">{{ $item->item_name }}</td>
                                <td></td>
                                <td>{{date('m/d/Y',strtotime($ia->date_received))}}</td>
                                <td>{{number_format($item->unit_cost,2) }}</td>
                            </tr>

                            @if(!empty($item->brand))
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $item->brand }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endif

                            @if(!empty($item->model))
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $item->model }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endif

                            @if(!empty($item->serial_no))
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $item->serial_no }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endif
                            @php $row++; @endphp
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
                                <td colspan="6">&nbsp;</td>
                            </tr>
                            <tr class="par_signatory">
                              <td colspan="3">Received by:<br><br>
                                 <div>
                                    <p><u><b>JAKE BRANDON L. AGDA / Nurse I</b></u>
                                    <br>(Name & Description)
                                    </p>

                                    <p><u><b>Office of the CDRRM</b></u>
                                    <br>(Office/Department/Agency)
                                    </p>

                                    <p>Date</p>
                                 </div>
                              </td>
                              <td colspan="3">Issued by:
                                 <div>
                                    <p><u><b>ENGR. JAIME J. VOCES/ CDRRMO</b></u>
                                    <br>(Name & Description)
                                    </p>

                                    <p><u><b>Office of the CDRRM</b></u>
                                    <br>(Office/Department/Agency)
                                    </p>

                                    <p>Date</p>
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
