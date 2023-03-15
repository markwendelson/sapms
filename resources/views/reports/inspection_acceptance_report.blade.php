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
    </div>

    <div class="for_pr">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="page">
                    <div class="page-header-space"></div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 text-center pt-3" style="font-size: 15pt;">
                            <b>--ooo--</b>
                        </div>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-9">
                        <b>ALMA D. CANDIDO, CPA</b><br>
                        State Auditor IV<br>
                        COA Eastern Samar<br>
                        Provincial Field Office<br>
                        Borongan City
                        </div>
                        <div class="col-3">Date: <u style="text-transform: uppercase;">{{date('F d, Y',strtotime($ia->created_at))}}</u></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-10">
                            &emsp; &emsp;&emsp; In compliance with COA existing rules and regulation under Section 6.9 of COA Circular No. 2009-002 and Sec. 114,
                            Rule 15. COA Cir. 92-386, undersigned respectfully furnish your office copies of <b>Inspection And Acceptance Report</b>
                            and copies of delivery documents with in twenty four (24) hours.
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-7">
                           <b>Requisitioning Office/Department:</b> <u>{{$ia->name}}</u>
                        </div>
                        <div class="col-3">
                           <b>IAR No.:</b> <u>{{$ia->iar_no}}</u>
                        </div>
                    </div>
                    <br>
                    <table class="table table-bordered m-0">
                        <thead class="text-center align-items-center">
                            <th>ITEM NO.</th>
                            <th>UNIT</th>
                            <th>DESCRIPTION</th>
                            <th>QUANTITY</th>
                            <th>REMARKS</th>
                        </thead>
                        <tbody>
                            @php
                                $row = 1;
                                $limit = 35;
                            @endphp
                            @foreach ($ia_details as $item)
                            <tr>
                                <td class="text-center">{{$row}}</td>
                                <td class="text-center">{{$item->unit_of_measure}}</td>
                                <td>{!! $item->item_name.' - '.nl2br($item->item_description) !!}</td>
                                <td class="text-center">50</td>
                                <td></td>
                            </tr>

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
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                  <br>
                  <div class="row">
                     <div class="col-6">
                        <div class="row">
                            <p style="text-decoration:italic;">Supplier:</p>
                           <div class="col-2"></div>
                           <div class="col-8 border-2 border-bottom text-center" style="font-weight:bold;">
                              MR.ROMEO T. VOCES
                           </div>
                           <div class="col-2"></div>
                        </div>
                        <div class="row">
                           <div class="col-2"></div>
                           <div class="col-8 text-center">
                              Signature Over Printed Name
                           </div>
                           <div class="col-2"></div>
                        </div>

                        <div class="row">
                            <p style="text-decoration:italic;">Verified by:</p>
                           <div class="col-2"></div>
                           <div class="col-8 border-2 border-bottom text-center" style="font-weight:bold;">
                              ANALYN T. APAREJADO
                           </div>
                           <div class="col-2"></div>
                        </div>
                        <div class="row">
                           <div class="col-2"></div>
                           <div class="col-8 text-center">
                              Storekeeper-Designate
                           </div>
                           <div class="col-2"></div>
                        </div>

                        <div class="row">
                           <div class="col-12 text-left pt-3">
                              <b>Note:</b> The above item subjects for Inspection are under quarantine for three (3) days.
                           </div>
                        </div>

                     </div>
                     <div class="col-6">
                     <div class="row">
                            <p style="text-decoration:italic;">Requested by:</p>
                           <div class="col-3"></div>
                           <div class="col-7 border-2 border-bottom text-center" style="font-weight:bold;">
                              ARIEL V. CUNA
                           </div>
                           <div class="col-2"></div>
                        </div>
                        <div class="row">
                           <div class="col-3"></div>
                           <div class="col-7 text-center">
                              City General Services Officer
                           </div>
                           <div class="col-2"></div>
                        </div>

                        <div class="row"><br>
                           <div class="col-3"></div>
                           <div class="col-7 border-2 border-bottom text-center" style="font-weight:bold;"><br><br>
                              ANNIE GLENA B. BARASTAS
                           </div>
                           <div class="col-2"></div>
                        </div>
                        <div class="row">
                           <div class="col-3"></div>
                           <div class="col-7 text-center">
                              Storekeeper-Designate
                           </div>
                           <div class="col-2"></div>
                        </div>
                        <div class="row"><br>
                           <div class="col-3"></div>
                           <div class="col-7 border-2 border-bottom text-center" style="font-weight:bold;"><br><br>
                              ARIEL V. CUNA
                           </div>
                           <div class="col-2"></div>
                        </div>
                        <div class="row">
                           <div class="col-3"></div>
                           <div class="col-7 text-center">
                              CGSO
                           </div>
                           <div class="col-2"></div>
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
