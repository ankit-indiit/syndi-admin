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
                                <li class="breadcrumb-item"><a href="{{ route('group.index') }}">Groups</a></li>
                                <li class="breadcrumb-item active">Add Group</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add Group</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    <a href="{{ route('group.index') }}" class="btn btn-primary  mb-3">Back To Groups</a>
                                </div>
                            </div>
                            {{ Form::open(['url' => route('group.store'), 'id' => 'addGroupForm']) }}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('name', "Group Name") }}
                                        {{ Form::text('name', '', [
                                                'class' => 'form-control',
                                                'placeholder' => 'Enter Your Group Name'
                                            ])
                                        }}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {{ Form::label('members', 'Group Member') }}
                                        <div class="dropdown bootstrap-select show-tick">
                                            {{ Form::select('members[]', getAllUsers(), '', [
                                                'class' => 'multiple form-control',
                                                'multiple' => '',
                                            ]); }}                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {{ Form::label('description', 'Description') }}
                                        {{ Form::textarea('description', '', ['class' => 'form-control', 'rows' => 4]) }}
                                    </div>
                                </div>
                                {{ Form::hidden('user_id', Auth::id()) }}
                                <div class="col-12 d-flex justify-content-between mt-3">
                                    <div class="form-group">
                                        {{ Form::label('status', 'Status') }}
                                        <div class="input-group">
                                            <label class="switch">
                                                {{ Form::checkbox('status', true, '') }}
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        {{ Form::button('<i class="fe-check-circle mr-1"></i> Submit', [
                                            'class' => 'btn btn-success waves-effect waves-light m-1',
                                            'id' => 'addGroupFormBtn',
                                            'type' => 'submit',
                                        ]) }}
                                        {{ Form::button('<i class="fe-x mr-1"></i> Cancel', [
                                            'class' => 'btn btn-light waves-effect waves-light m-1',
                                            'id' => '',
                                            'type' => 'button',
                                        ]) }}                                        
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layout.footer')
    </div>
</div>
@endsection
@section('customScript')
<script src="{{ asset('assets/admin/js/jquery.validate.min.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.multiple').select2();
    });

    $("#addGroupForm").validate({
        rules: {                
            name: {
                required: true,
            },                
            description: {
                required: true,
            },                
        },            
        messages: {
           name: "Please enter name!",                                   
           description: "Please enter description!",                                            
        },
        submitHandler: function(form) {
            $('#addGroupFormBtn').attr('disabled', true);         
            $('#addGroupFormBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
            var serializedData = new FormData(form);
            $.ajax({
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                },
                type: 'post',
                url: "{{ route('group.store') }}",
                data: serializedData,
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {               
                    if (data.status == true) {
                        $('#addGroupFormBtn').attr('disabled', false);   
                        $('#addGroupFormBtn').html('<i class="fe-check-circle mr-1"></i> Submit');
                        toastr.success(data.message);
                        $('#addGroupForm').trigger("reset");                     
                    } else {
                        $('#addGroupFormBtn').attr('disabled', false);   
                        $('#addGroupFormBtn').html('<i class="fe-check-circle mr-1"></i> Submit');
                        toastr.error(data.errors);                            
                    }
                }
            });
           return false;
        }
    });
</script>
@endsection