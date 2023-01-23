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
                                <li class="breadcrumb-item active">Contacts</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Contacts</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="header-title mb-3">All Contacts </h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ route('contact.create') }}" class="btn btn-primary  mb-3">Add Contact</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="contactDatatable" class="table table-border listing-data-table">
                                            <thead>
                                                <th>Phone Number</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Group</th>
                                                <th>Source</th>
                                                <th>Added</th>
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
        var table = $('#contactDatatable').DataTable({
            processing: true,
            serverSide: true,
            order: [[5, 'desc']],
            ajax: "{{ route('contact.index') }}",
            columns: [               
                {
                    data: 'phone_number',
                    name: 'phone_number'
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
                    data: 'group',
                    name: 'group',
                    searchable: false
                },
                {
                    data: 'source',
                    name: 'source',
                    searchable: false
                },
                {
                    data: 'added',
                    name: 'added',
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

    $(document).on('click', '#deleteContact', function(){
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
                url: "{{ url('admin/contact') }}/"+id,
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