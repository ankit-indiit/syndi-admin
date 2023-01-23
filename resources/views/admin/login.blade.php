<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Log In </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="{{ asset('assets/admin/images/logo-sm.png') }}">
        <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
        <link href="{{ asset('assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
        <link href="{{ asset('assets/admin/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
        <link href="{{ asset('assets/admin/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
        <link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/css/toastr.css') }}" rel="stylesheet" />
    </head>
    <body class="loading authentication-bg">
        <div class="account-pages">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern mb-0">
                            <div class="card-body p-4">
                                <div class="text-center w-75 m-auto">
                                    <div class="auth-logo">
                                        <a href="login.php" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                        <img src="{{ asset('assets/admin/images/logo.png') }}" alt="" height="50">
                                        </span>
                                        </a>
                                    </div>
                                    <p class="text-muted mb-4 mt-3">Enter your email address and password to access admin panel.</p>
                                </div>
                                {{ Form::open(['url' => route('admin.login'), 'id' => 'adminLogin']) }}
                                    <div class="form-group mb-3">                                        
                                        {{ Form::label('email', 'Email address') }}
                                        {{ Form::text('email', old('email'),[
                                                'class' => 'form-control',
                                                'placeholder' => 'Enter Email'
                                        ]) }}
                                    </div>
                                    <div class="form-group mb-3">
                                        {{ Form::label('password', 'Password') }}
                                        <div class="input-group input-group-merge">
                                            {{ Form::input('password', 'password', '', [
                                                    'type' => 'password',
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Enter Password'
                                            ]) }}
                                            <div class="input-group-append" data-password="false">
                                                <div class="input-group-text">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-signin"  checked  >
                                            <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 text-center">
                                        {{ Form::button('Log In', [
                                            'class' => 'btn btn-primary btn-block',
                                            'id' => 'addUserFormBtn',
                                            'type' => 'submit',
                                        ]) }}
                                    </div>
                                </form>
                                {{-- <div class="row mt-3">
                                    <div class="col-12 text-center">
                                        <p> <a href="forgotpassword.php" class="ml-1">Forgot your password?</a></p>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/admin/js/vendor.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/app.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/toastr.js') }}"></script>
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