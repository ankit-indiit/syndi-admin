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
                                <li class="breadcrumb-item"><a href="{{ route('contact.index') }}">Contacts</a></li>
                                <li class="breadcrumb-item active">Add Contact</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add Contact</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    <a href="{{ route('contact.index') }}" class="btn btn-primary  mb-3">Back To Contacts</a>
                                </div>
                            </div>
                            {{ Form::open(['url' => route('contact.store'), 'id' => 'addContactForm']) }}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">                                       
                                        {{ Form::label('first_name', "First Name") }}
                                        {{ Form::text('first_name', '', [
                                                'class' => 'form-control',
                                                'placeholder' => 'Enter Your First Name'
                                            ])
                                        }}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">                                       
                                        {{ Form::label('last_name', "Last Name") }}
                                        {{ Form::text('last_name', '', [
                                                'class' => 'form-control',
                                                'placeholder' => 'Enter Your Last Name'
                                            ])
                                        }}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">                                        
                                        {{ Form::label('email', "Email") }}
                                        {{ Form::text('email', '', [
                                                'class' => 'form-control',
                                                'placeholder' => 'Enter Your Email'
                                            ])
                                        }}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">                                        
                                        {{ Form::label('phone_number', "Phone No") }}
                                        {{ Form::text('phone_number', '', [
                                                'class' => 'form-control',
                                                'placeholder' => 'Enter Your Phone No'
                                            ])
                                        }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('group_ids', 'Group') }}
                                        {{ Form::select('group_ids', getAllGroup(), '', [
                                            'class' => 'form-control',
                                        ]); }}                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('user_id', 'User') }}
                                        {{ Form::select('user_id', getAllUsers(), '', [
                                            'class' => 'form-control',
                                        ]); }}                                        
                                    </div>
                                </div>
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
                                    <div class="form-group">
                                        {{ Form::label('block', 'Block') }}
                                        <div class="input-group">
                                            <label class="switch">
                                                {{ Form::checkbox('block', true, '') }}
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        {{ Form::button('<i class="fe-check-circle mr-1"></i> Submit', [
                                            'class' => 'btn btn-success waves-effect waves-light m-1',
                                            'id' => 'addContactFormBtn',
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
<script type="text/javascript">
    $("#addContactForm").validate({
        rules: {                
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },                
            email: {
                required: true,
            },
            phone_number: {
                required: true,
            },
            group_ids: {
                required: true,
            },
            user_id: {
                required: true,
            },
        },            
        messages: {
           first_name: "Please enter name!",                                   
           last_name: "Please enter name!",                                   
           email: "Please enter email!",                                            
           phone_number: "Please enter phone!",                                            
           group_ids: "Please choose group!",                                            
           user_id: "Please choose user!",                                            
        },
        submitHandler: function(form) {
            $('#addContactFormBtn').attr('disabled', true);         
            $('#addContactFormBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
            var serializedData = new FormData(form);
            $.ajax({
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                },
                type: 'post',
                url: "{{ route('contact.store') }}",
                data: serializedData,
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                success: function(data) {               
                    if (data.status == true) {
                        $('#addContactFormBtn').attr('disabled', false);   
                        $('#addContactFormBtn').html('<i class="fe-check-circle mr-1"></i> Submit');
                        toastr.success(data.message);
                        $('#addContactForm').trigger("reset");                     
                    } else {
                        $('#addContactFormBtn').attr('disabled', false);   
                        $('#addContactFormBtn').html('<i class="fe-check-circle mr-1"></i> Submit');
                        toastr.error(data.errors);                            
                    }
                }
            });
           return false;
        }
    });
</script>
@endsection