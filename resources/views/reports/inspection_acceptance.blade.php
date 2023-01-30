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
            height: 80px !important;
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
            thead {display: table-header-group !important;}
            tfoot {display: table-footer-group !important;}


            .page-footer {
                display: block;
                position: fixed;
                bottom: 0;
                width: 100%;
            }

            .page-header {
                display:block;
                position: fixed;
                top: 0 !important;
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

            body {  margin: 100px 25px !important;}

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
        <br><br><br>
    </div>

    <div>
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="page for_inspection">
                    <div class="page-header-space">

                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center pt-3 " style="font-size: 15pt;">
                            <b>INSPECTION AND ACCEPTANCE REPORT</b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            Supplier :
                        </div>
                        <div class="col-6 border-1 border-bottom">
                            {{$ia->supplier_name}}
                        </div>
                        <div class="col-2">
                            IAR No :
                        </div>
                        <div class="col-2 border-1 border-bottom">
                            {{$ia->iar_no}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            PO No :
                        </div>
                        <div class="col-6 border-1 border-bottom">
                            {{$ia->po_no}}
                        </div>
                        <div class="col-2">
                            Invoice No :
                        </div>
                        <div class="col-2 border-1 border-bottom">
                            {{$ia->invoice_no}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            Department :
                        </div>
                        <div class="col-6 border-1 border-bottom">
                            {{$ia->name}}
                        </div>
                        <div class="col-2">
                            Date :
                        </div>
                        <div class="col-2 border-1 border-bottom">
                            {{date('m/d/Y',strtotime($ia->created_at))}}
                        </div>
                    </div>
                    <br>
                    <table class="table table-bordered m-0">
                        <thead class="text-center align-items-center">
                            <th width="5%" >STOCK NO.</th>
                            <th width="5%">UNIT</th>
                            <th width="40%">ITEMS AND DESCRIPTION</th>
                            <th>QTY</th>
                            <th>TYPE</th>
                            <th width="10%">MODEL</th>
                            <th>BRAND</th>
                            <th width="10%">SERIAL NO.</th>
                        </thead>
                        <tbody >
                           @php $row = 1; @endphp
                           @foreach ($ia_details as $item)
                               <tr class="text-center">
                                   <td >{{$row}}</td>
                                   <td>{{$item->unit_of_measure}}</td>
                                   <td>{!! $item->item_name.' - '.nl2br($item->item_description) !!}</td>
                                   <td>{{(int)$item->quantity_received}}</td>
                                   <td>{{$item->type}}</td>
                                   <td>{{$item->model}}</td>
                                   <td>{{$item->brand}}</td>
                                   <td>{{$item->serial_no}}</td>
                               </tr>
                               @php $row++;@endphp
                           @endforeach
                        </tbody>
                    </table>

                    <div class="row  p-0 m-0 ">
                        <div class="col-6 text-center border ">
                            INSPECTION
                        </div>
                        <div class="col-6 text-center border ">
                            ACCEPTANCE
                        </div>
                    </div>
                    <div class="row p-0 m-0 for_inspection">
                        {{-- inspection --}}
                        <div class="col-6 text-center border ">
                            <div class="row py-3">
                                <div class="col-5">
                                    Date Inspected:
                                </div>
                                <div class="col-5 border-1 border-bottom">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 offset-1">
                                    <div class="card" >
                                        <div class="card-body">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-7 py-1">
                                    <p class="mb-0"> Inspected, verified & found OK as to quantity &
                                    <br> Inspections</p>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-3 ">
                                    Observation:
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-10 offset-1  border-1 border-bottom">
                                </div>
                            </div>
                            <div class="row pt-2 text-center">
                                <div class="col-7 offset-1  border-1 border-bottom ">
                                    <b> GINA M. CARGANDO</b>
                                </div>
                                <div class="col-2 offset-1  border-1 border-bottom">
                                </div>
                            </div>
                            <div class="row p-0 ">
                                <div class="col-7 offset-1">
                                    Inspection Officer / TWG BAC
                                </div>
                                <div class="col-2 offset-1 ">
                                    Date
                                </div>
                            </div>
                            <div class="row pt-2 text-center">
                                <div class="col-7 offset-1  border-1 border-bottom ">
                                   <b>  GERTRUDES B. CARDONA</b>
                                </div>
                                <div class="col-2 offset-1  border-1 border-bottom">
                                </div>
                            </div>
                            <div class="row p-0 ">
                                <div class="col-7 offset-1">
                                    Inspection Officer / TWG BAC
                                </div>
                                <div class="col-2 offset-1 ">
                                    Date
                                </div>
                            </div>
                            <div class="row pt-2 text-center">
                                <div class="col-7 offset-1  border-1 border-bottom ">
                                   <b>  PERPETUA C. AMOYAN</b>
                                </div>
                                <div class="col-2 offset-1  border-1 border-bottom">
                                </div>
                            </div>
                            <div class="row p-0 ">
                                <div class="col-7 offset-1">
                                    Inspection Officer / TWG BAC
                                </div>
                                <div class="col-2 offset-1 ">
                                    Date
                                </div>
                            </div>
                            <div class="row pt-2 text-center">
                                <div class="col-7 offset-1  border-1 border-bottom ">
                                   <b>  ALLAN M. CASILLANO</b>
                                </div>
                                <div class="col-2 offset-1  border-1 border-bottom">
                                </div>
                            </div>
                            <div class="row p-0 ">
                                <div class="col-7 offset-1">
                                    Inspection Officer / CGSO
                                </div>
                                <div class="col-2 offset-1 ">
                                    Date
                                </div>
                            </div>
                            <div class="row pt-2 text-center">
                                <div class="col-7 offset-1  border-1 border-bottom ">
                                   <b>  BONIFACIO S. BADILLO, JR.</b>
                                </div>
                                <div class="col-2 offset-1  border-1 border-bottom">
                                </div>
                            </div>
                            <div class="row p-0 ">
                                <div class="col-7 offset-1">
                                    Inspection Officer / CGSO
                                </div>
                                <div class="col-2 offset-1 ">
                                    Date
                                </div>
                            </div>
                            <div class="row pt-2 text-center">
                                <div class="col-7 offset-1  border-1 border-bottom ">
                                   <b>  GABRIEL O. CABO</b>
                                </div>
                                <div class="col-2 offset-1  border-1 border-bottom">
                                </div>
                            </div>
                            <div class="row p-0 ">
                                <div class="col-7 offset-1">
                                    Inspection / CGSO
                                </div>
                                <div class="col-2 offset-1 ">
                                    Date
                                </div>
                            </div>
                                <br><br><br>
                        </div>
                        {{-- acceptance --}}
                        <div class="col-6 text-center border ">
                            <div class="row py-3">
                                <div class="col-5">
                                    Date Received:
                                </div>
                                <div class="col-5 border-1 border-bottom">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 offset-1">
                                   Remarks:
                                </div>
                            </div>
                            <div class="row py-1">
                                <div class="col-3 offset-2">
                                    <div class="card" >
                                        <div class="card-body">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 m-0 py-2">
                                    Completed
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 offset-2">
                                    <div class="card" >
                                        <div class="card-body">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 text-left m-0 py-2">
                                    Partial (pls. specify quantity)
                                </div>
                            </div>
                            <div class="row pt-3 text-center">
                                <div class="col-10 offset-1  border-1 border-bottom ">
                                </div>
                            </div>
                            <div class="row pt-3 text-center">
                                <div class="col-10 offset-1  border-1 border-bottom ">
                                </div>
                            </div>
                            <div class="row pt-3 text-center">
                                <div class="col-10 offset-1  border-1 border-bottom ">
                                </div>
                            </div>
                            <div class="row pt-3 text-center">
                                <div class="col-10 offset-1  border-1 border-bottom ">
                                </div>
                            </div>
                            <div class="row pt-3 text-center">
                                <div class="col-10 offset-1  border-1 border-bottom ">
                                </div>
                            </div>
                            <br><br><br><br><br><br>
                            <div class="row pt-2 text-center">
                                <div class="col-7 offset-1  border-1 border-bottom ">
                                   <b>  ARIEL V. CUNA</b>
                                </div>
                                <div class="col-2 offset-1  border-1 border-bottom">
                                </div>
                            </div>
                            <div class="row p-0 ">
                                <div class="col-7 offset-1">
                                    CGSO
                                </div>
                                <div class="col-2 offset-1 ">
                                    Date
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.report.scripts')
    <script type="text/javascript">
        $(document).ready(function(){
        //    alert( $('.table').height());
        })
        </script>
    @yield('scripts')

</body>

</html>
