@extends('admin.layout.master')
@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Users</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Users</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="header-title mb-3">All Users </h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('user.create') }}" class="btn btn-primary  mb-3">Add User</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">                               
                                <div class="row">
                                    <div class="col-sm-12 table-responsive">
                                        <table id="usersDatatable" class="table table-border listing-data-table">
                                            <thead>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layout.footer')
</div>
@endsection
@section('customScript')
<link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
    $(function() {
        var table = $('#usersDatatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('user.index') }}",
            columns: [
                {
                    data: 'image',
                    name: 'image',
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email',
                    searchable: false
                },
                {
                    data: 'status',
                    name: 'status',
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

    });

    $(document).on('click', '#deleteUser', function(){
        var id = $(this).data('id');
        $('#deleteModal').modal('show');
        $('#deleteModalBtn').click(function(){
            $('#deleteModalBtn').attr('disabled', true);
            $('#deleteModalBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
            $.ajax({
                headers: {
                   'X-CSRF-Token': $('input[name="_token"]').val()
                },
                type: 'DELETE',
                url: "{{ url('admin/user') }}/"+id,
                data: { id: id },               
                success: function(data) {               
                    if (data.status == true) {
                        $('#deleteModalBtn').attr('disabled', false);
                        $('#deleteModalBtn').html('Delete');
                        $('#deleteModal').modal('hide');
                        toastr.success(data.message);
                        window.location.reload();                                    
                    } else {                    
                        toastr.error(data.errors);                            
                    }
                }
            });
        })
    })
</script>
@endsection