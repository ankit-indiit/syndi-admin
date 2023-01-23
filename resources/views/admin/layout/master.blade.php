<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>SyndicateSms</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.png') }}">
        <link href="{{ asset('assets/admin/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
        <link href="{{ asset('assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
        <link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('assets/admin/css/chosen.css') }}">
        <link href="{{ asset('assets/admin/css/summernote.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-select.css') }}" />
        <link href="{{ asset('assets/admin/css/toastr.css') }}" rel="stylesheet" />
    </head>
    </head>
    <body class="loading">
        <div id="wrapper">
            
            @include('admin.layout.header')
            
            @include('admin.layout.sidebar')
           
            @yield('content')
            <div class="modal delete_modal fade" id="deleteModal" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="delete-cont">
                                <i class="far fa-times-circle"></i>
                                <h3>Are you sure?</h3>
                                <p>Are you sure you want to delete this record? This process cannot be undone</p>
                                <input type="hidden" name="id" id="id">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="deleteModalBtn">Delete</button>
                        </div>
                    </div>
                </div>
            </div> 
        </div>        
        <div class="rightbar-overlay"></div>
        <script src="{{ asset('assets/admin/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/admin/libs/flatpickr/flatpickr.min.js') }}"></script>
        <script src="{{ asset('assets/admin/libs/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/admin/libs/selectize/js/standalone/selectize.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/pages/dashboard-1.init.js') }}"></script>
        <script src="{{ asset('assets/admin/js/app.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/toastr.js') }}"></script>
        @yield('customScript')

        <script type="text/javascript">
            $(document).ready(function() {
                toastr.options.timeOut = 10000;
                @if (Session::has('error'))
                    toastr.error('{{ Session::get('error') }}');
                @endif
                @if(Session::has('success'))
                    toastr.success('{{ Session::get('success') }}');
                @endif
            });        
        </script>
    </body>
</html>