<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Gnonel | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Notre objectif est de faciliter la passation des Marchés." name="description" />
    <meta content="KOF CORPORATION" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backoffice/images/favicon.ico') }}">

    <!-- Plugins css -->
    <link href="{{ asset('backoffice/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backoffice/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- App css -->
    <link href="{{ asset('backoffice/css/config/default/bootstrap_.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="{{ asset('backoffice/css/config/default/app_.min.css') }}" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />

    <link href="{{ asset('backoffice/css/config/default/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-dark-stylesheet" />
    <link href="{{ asset('backoffice/css/config/default/app-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="{{ asset('backoffice/css/icons.min.css') }}" rel="stylesheet" type="text/css" />


    <!-- third party css -->
    <link href="{{ asset('backoffice/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backoffice/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('backoffice/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('backoffice/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <style type="text/css">
        #my-table {
            width: 100%;
        }

        #my-table .left {
            text-align: left;
            width: 50%;
            padding: 10px;
        }

        #my-table .right {
            text-align: right;
            font-weight: bold;
            width: 50%;
            padding: 10px;
        }

        #my-table tr {
            border-bottom: 1px solid #e5a719;

        }

        .accordion-button:not(.collapsed) {
            color: #e5a719;
        }

        section .section-body form .card-body .col {
            margin-bottom: 15px;
        }

        section .section-body form .card-body .col label {
            margin-bottom: 5px;
        }

        .new-form .card-body .form-group {
            margin-bottom: 15px;
        }

        .new-form .card-body .form-group label {
            margin-bottom: 5px;
        }

        .modal .form-group {
            margin-bottom: 15px;
        }

        .modal .form-group label {
            margin-bottom: 5px;
        }
    </style>
</head>

<!-- body start -->

<body class="loading"
    data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
    @if (Session::has('flash_message_error'))
        <script type="text/javascript" src="{{ asset('backoffice/js/sweetalert.min.js') }}"></script>
        <script type="text/javascript">
            swal("{{ session('flash_message_error') }}", "Merci", "error");
        </script>
    @endif
    @if (Session::has('update_no'))
        <script type="text/javascript" src="{{ asset('backoffice/js/sweetalert.min.js') }}"></script>
        <script type="text/javascript">
            swal("{{ session('update_no') }}", "Merci", "error");
        </script>
    @endif
    @if (Session::has('flash_message_success'))
        <script type="text/javascript" src="{{ asset('backoffice/js/sweetalert.min.js') }}"></script>
        <script type="text/javascript">
            swal("{{ session('flash_message_success') }}", "Merci", "success");
        </script>
    @endif
    @if (Session::has('update_ok'))
        <script type="text/javascript" src="{{ asset('backoffice/js/sweetalert.min.js') }}"></script>
        <script type="text/javascript">
            swal("{{ session('update_ok') }}", "Merci", "success");
        </script>
    @endif
    @if (Session::has('add_ok'))
        <script type="text/javascript" src="{{ asset('backoffice/js/sweetalert.min.js') }}"></script>
        <script type="text/javascript">
            swal("{{ session('add_ok') }}", "Merci", "success");
        </script>
    @endif
    @if (Session::has('flash_message_warning'))
        <script type="text/javascript" src="{{ asset('backoffice/js/sweetalert.min.js') }}"></script>
        <script type="text/javascript">
            swal("{{ session('flash_message_warning') }}", "Merci", "warning");
        </script>
    @endif
    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        @include('partials.backoffice.header')

        <!-- ========== Left Sidebar Start ========== -->

        <!-- Left Sidebar End -->
        @include('partials.backoffice.sidebar')
        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                @yield('content')

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> &copy; Gnonel powered by <a href="https://kofcorporation.com"
                                target="_blank">KOFCORPORATION</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->


    <!-- Vendor js -->
    <script src="{{ asset('backoffice/js/vendor.min.js') }}"></script>

    <!-- Plugins js-->
    <script src="{{ asset('backoffice/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('backoffice/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ asset('backoffice/libs/selectize/js/standalone/selectize.min.js') }}"></script>

    <!-- Dashboar 1 init js-->
    <script src="{{ asset('backoffice/js/pages/dashboard-1.init.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ asset('backoffice/libs/chart.js/Chart.bundle.min.js') }}"></script>

    <!-- Init js -->
    <!--<script src="{{ asset('backoffice/js/pages/chartjs.init.js') }}"></script>-->


    <!-- third party js -->
    <script src="{{ asset('backoffice/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backoffice/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backoffice/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backoffice/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backoffice/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backoffice/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backoffice/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backoffice/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('backoffice/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backoffice/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('backoffice/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('backoffice/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backoffice/libs/pdfmake/build/vfs_fonts.js') }}"></script>

    <!-- Datatables init -->
    <script src="{{ asset('backoffice/js/pages/datatables.init.js') }}"></script>

    <!-- App js-->
    <script src="{{ asset('backoffice/js/app.min.js') }}"></script>


    @yield('script')
</body>

</html>
