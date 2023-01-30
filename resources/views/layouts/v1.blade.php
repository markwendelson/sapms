<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{ asset('libs/toastr/build/toastr.min.css') }}">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        .table thead tr {
            vertical-align: middle;
            text-align: center;
            font-weight: 600;
            text-transform: uppercase;
        }
    </style>

    @stack('extra_css')
</head>
<body data-sidebar="dark">
    <div id="app">

        <!-- Begin page -->
        <div id="layout-wrapper">

            @include('partials.top-bar')
            @include('partials.left-sidebar')

            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        @yield('content')
                        <!-- end page title -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                    <strong>{{ config('app.name', 'Laravel') }} -  Municipality of {{env('APP_CITY')}}</strong>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    {{-- Develop by Apluszure I.T Solutions --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>

        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Scripts -->
    {{-- <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="{{ asset('libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('libs/toastr/build/toastr.min.js') }}"></script>

    <script src="{{ asset('js/layout.js') }}"></script>

    <script type="text/javascript">
        function closePrint () {
          document.body.removeChild(this.__container__);
        }

        function setPrint () {
          this.contentWindow.__container__ = this;
          this.contentWindow.onbeforeunload = closePrint;
          this.contentWindow.onafterprint = closePrint;
          this.contentWindow.focus(); // Required for IE
          this.contentWindow.print();
        }

        function printPage (sURL) {
          var oHideFrame = document.createElement("iframe");
          oHideFrame.onload = setPrint;
          oHideFrame.style.position = "fixed";
          oHideFrame.style.right = "0";
          oHideFrame.style.bottom = "0";
          oHideFrame.style.width = "0";
          oHideFrame.style.height = "0";
          oHideFrame.style.border = "0";
          oHideFrame.src = sURL;
          document.body.appendChild(oHideFrame);
        }
    </script>
    @stack('scripts')

</body>
</html>
