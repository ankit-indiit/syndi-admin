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
                                <li class="breadcrumb-item active">Edit User</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit User</h4>
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
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class=" profile_user">
                                        <div class="card">
                                            <div class="card-body text-center">
                                                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype='multipart/form-data' id="userImageForm">
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="id" value="{{ @$user->id }}">
                                                    <input type="hidden" name="type" value="image">
                                                    <div class="user-image ">
                                                        <img class="rounded-circle img-thumbnail" id="userImage" src="{{ @$user->image }}">
                                                        <label for="userImg">Upload Image</label>
                                                        <input id="userImg" name="user_img" style="visibility: hidden;" type="file">
                                                    </div>   
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    {{ Form::open(['url' => route('user.update', $user->id), 'id' => 'updateUserForm']) }}
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                {{ Form::label('full_name', 'Name') }}
                                                {{ Form::text('full_name', @$user->full_name,[
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter Name'
                                                ]) }}
                                            </div>
                                        </div>                                       
                                        <div class="col-lg-6">
                                            <div class="form-group">                        
                                                {{ Form::label('email', 'Email') }}
                                                {{ Form::text('email', @$user->email,[
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Enter Email'
                                                ]) }}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">                        
                                                {{ Form::label('phone', 'Phone No') }}
                                                {{ Form::text('phone', @$user->phone,[
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
                                                        'placeholder' => 'Enter Password'
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
                                                        {{ Form::checkbox('status', true, @$user->status == 1 ? 'checked' : '') }}
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="type" value="detail">
                                    <div class="row mt-3">
                                        <div class="col-12 text-right">
                                            {{ Form::button('<i class="fe-check-circle mr-1"></i> Submit', [
                                                'class' => 'btn btn-success waves-effect waves-light m-1',
                                                'id' => 'updateUserFormBtn',
                                                'type' => 'submit',
                                            ]) }}
                                            {{ Form::button('<i class="fe-x mr-1"></i> Cancel', [
                                                'class' => 'btn btn-light waves-effect waves-light m-1',
                                                'type' => 'button',
                                            ]) }}
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>                            
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
        var formData = new FormData(document.getElementById('userImageForm'));
        $.ajax({
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            type: 'POST',
            url: "{{ route('user.update', $user->id) }}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {               
                if (data.status == true) {                                    
                    toastr.success(data.message);                                       
                } else {                    
                    toastr.error(data.errors);                            
                }
            }
        });
    })

    $("#updateUserForm").validate({
            rules: {                
                name: {
                    required: true,
                },                
                email: {
                    required: true,
                },
                phone: {
                    required: true,
                },                
            },            
            messages: {
               name: "Please enter first name!",                                   
               email: "Please enter email!",                                   
               phone: "Please enter phone!",                                                
            },
            /*submitHandler: function(form) {
                $('#updateUserFormBtn').attr('disabled', true);         
                $('#updateUserFormBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = new FormData(form);
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'PUT',
                    url: "{{ route('user.update', $user->id) }}",
                    data: serializedData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {               
                        if (data.status == true) {
                            $('#updateUserFormBtn').attr('disabled', false);   
                            $('#updateUserFormBtn').html('<i class="fe-check-circle mr-1"></i> Submit');
                            toastr.success(data.message);
                            $('#updateUserForm').trigger("reset");                     
                        } else {
                            $('#updateUserFormBtn').attr('disabled', false);   
                            $('#updateUserFormBtn').html('<i class="fe-check-circle mr-1"></i> Submit');
                            toastr.error(data.errors);                            
                        }
                    }
                });
               return false;
            }*/
        });
</script>
@endsection