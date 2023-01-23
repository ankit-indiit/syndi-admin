@extends('admin.layout.master')
@section('content')
<div class="content-page">
    <div class="content invoice_div">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
                                <li class="breadcrumb-item active">View User</li>
                            </ol>
                        </div>
                        <h4 class="page-title">View User</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <a href="{{ route('user.index') }}" class="btn btn-primary mb-3">Back To Users</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="orderviewdetail">
                                    <h4 class="headsub">User Details</h4>
                                    <ul class="details-all">
                                        <li>
                                            <span> Image: </span> 
                                            <div class="orderview-img"> 
                                                <img class="rounded img-thumbnail" src="{{ $user->image }}"> 
                                            </div>
                                        </li>
                                        <li> <span> Name: </span> {{ $user->full_name }} </li>
                                        <li> <span> Email: </span> {{ $user->email }} </li>
                                        <li> <span> Phone Number: </span> {{ $user->phone }} </li>
                                        <li> <span> Status: </span> {!! $user->status_badge !!} </li>
                                    </ul>
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