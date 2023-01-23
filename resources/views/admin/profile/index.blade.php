@extends('admin.layout.master')
@section('content')
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Profile</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="header-title mb-3">Profile Settings</h4>
                                </div>
                            </div>                            
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class=" profile_user">
                                            <div class="card">
                                                <div class="card-body text-center">
                                                    <form action="{{ route('admin.image') }}" method="POST" enctype='multipart/form-data' id="adminImageForm">
                                                        <input type="hidden" name="id" value="{{ Auth::id() }}">
                                                        <div class="user-image ">
                                                            <img class="rounded-circle img-thumbnail" id="adminImage" src="{{ Auth::user()->image }}">
                                                            <label for="userImg">Upload Image</label>
                                                            <input id="userImg" name="user_img" style="visibility: hidden;" type="file">
                                                        </div>   
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <form action="{{ route('admin.update') }}" method="POST" >
                                        @csrf
                                            <h4 class="headsub">Basic Info</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fullname">Full Name</label>
                                                        <input type="text" id="fullname" class="form-control" name="full_name" placeholder="Enter Your Full Name" value="{{ Auth::user()->full_name }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="emailaddress">Email Address</label>
                                                        <input type="email" id="emailaddress" class="form-control" placeholder="Enter Your Email Address" value="{{ Auth::user()->email }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="headsub">Change Password</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="oldpassword">Current Password</label>
                                                        <input type="password" id="oldpassword" class="form-control" name="password" placeholder="Enter Your Current Password" autocomplete="new-password">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="newpassword">New Password</label>
                                                        <input type="password" id="newpassword" class="form-control" placeholder="Enter Your New Password">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="confirmnewpassword">Confirm New Password</label>
                                                        <input type="password" id="confirmnewpassword" class="form-control" name="confirm_password" placeholder="Enter Your Confirm New Password">
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="{{ Auth::id() }}">
                                            <div class="row mt-3">
                                                <div class="col-12 text-right">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light m-1"><i class="fe-check-circle mr-1"></i> Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.layout.footer')
        </div>
    </div>
    <div class="rightbar-overlay"></div>
</div>
@endsection
@section('customScript')
<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/js/chosen.jquery.js') }}"></script>
<script src="{{ asset('assets/js/init.js') }}"></script>
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/create-project.init.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script type="text/javascript">    
    $(document).on('change', '#userImg', function(){
        const [file] = userImg.files

        if (file) {
            adminImage.src = URL.createObjectURL(file)
        }
        const form = document.getElementById('adminImageForm');
        const formData = new FormData(form);
        $.ajax({
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            type: 'post',
            url: "{{ route('admin.image') }}",
            data: formData,
            dataType: 'json',
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
</script>
@endsection