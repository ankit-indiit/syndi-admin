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
                                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
                                <li class="breadcrumb-item active">Add User</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add User</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 text-right">
                                    <a href="{{ route('user.index') }}" class="btn btn-primary  mb-3">Back To Users</a>
                                </div>
                            </div>
                            {{ Form::open(['url' => route('user.store'), 'id' => 'addUserForm']) }}
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class=" profile_user">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <div class="user-image ">
                                                   <img class="rounded-circle img-thumbnail" id="userImage" src="{{ asset('assets/admin/images/users/user.png') }}">
                                                    <label for="userImg">Upload Image</label>
                                                    <input id="userImg" name="user_img" style="visibility: hidden;" type="file">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                {{ Form::label('full_name', 'Name') }}
                                                {{ Form::text('full_name', '',[
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter Name'
                                                ]) }}
                                            </div>
                                        </div>                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">                        
                                                {{ Form::label('email', 'Email') }}
                                                {{ Form::text('email', '',[
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter Email',
                                                        'autocomplete' => 'new-password'
                                                ]) }}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">                        
                                                {{ Form::label('phone', 'Phone No') }}
                                                {{ Form::text('phone', '',[
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter Phone No'
                                                ]) }}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">                        
                                                {{ Form::label('password', 'Password') }}
                                                {{ Form::input('password', 'password', '', [
                                                        'type' => 'password',
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter Password',
                                                        'autocomplete' => 'new-password'
                                                ]) }}
                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">                        
                                                {{ Form::label('password', 'Confirm Password') }}
                                                {{ Form::input('password', 'confirm_password', '', [
                                                        'type' => 'password',
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter Password'
                                                ]) }}                                                
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <div class="input-group">
                                                    <label class="switch">
                                                        {{ Form::checkbox('status', true, '') }}
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 text-right">
                                            {{ Form::button('<i class="fe-check-circle mr-1"></i> Submit', [
                                                'class' => 'btn btn-success waves-effect waves-light m-1',
                                                'id' => 'addUserFormBtn',
                                                'type' => 'submit',
                                            ]) }}
                                            {{ Form::button('<i class="fe-x mr-1"></i> Cancel', [
                                                'class' => 'btn btn-light waves-effect waves-light m-1',
                                                'type' => 'button',
                                            ]) }}
                                        </div>
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
    $(document).on('change', '#userImg', function(){
        const [file] = userImg.files
        if (file) {
            userImage.src = URL.createObjectURL(file)
        }        
    })

    $("#addUserForm").validate({
            rules: {                
                full_name: {
                    required: true,
                },                
                email: {
                    required: true,
                },
                phone: {
                    required: true,
                },
                password: {
                    required: true,
                },
                confirm_password: {
                    required: true,
                },
            },            
            messages: {
               full_name: "Please enter name!",                                   
               email: "Please enter email!",                                   
               phone: "Please enter phone!",                                   
               password: "Please enter password!",                                   
               confirm_password: "Please enter confirm password!",                                   
            },
            submitHandler: function(form) {
                $('#addUserFormBtn').attr('disabled', true);         
                $('#addUserFormBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = new FormData(form);
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('user.store') }}",
                    data: serializedData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {               
                        if (data.status == true) {
                            $('#addUserFormBtn').attr('disabled', false);   
                            $('#addUserFormBtn').html('<i class="fe-check-circle mr-1"></i> Submit');
                            toastr.success(data.message);
                            $('#addUserForm').trigger("reset");                     
                        } else {
                            $('#addUserFormBtn').attr('disabled', false);   
                            $('#addUserFormBtn').html('<i class="fe-check-circle mr-1"></i> Submit');
                            toastr.error(data.errors);                            
                        }
                    }
                });
               return false;
            }
        });
</script>
@endsection