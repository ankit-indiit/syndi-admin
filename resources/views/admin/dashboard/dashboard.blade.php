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
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-xl-3">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-4">
                                <div class="avatar-lg rounded-circle bg-primary border-primary border">
                                    <i class="fe-users font-22 avatar-title text-white"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="text-right">
                                    <h3 class="mt-1"><span data-plugin="counterup">58,947</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Users</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xl-3">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-4">
                                <div class="avatar-lg rounded-circle bg-warning border-warning border">
                                    <i class="fe-users font-22 avatar-title text-white"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">1245</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Groups</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xl-3">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-4">
                                <div class="avatar-lg rounded-circle bg-success border-success border">
                                    <i class="fe-list font-22 avatar-title text-white"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">127</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Contacts</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-xl-3">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-4">
                                <div class="avatar-lg rounded-circle bg-info border-info border">
                                    <i class="fe-message-circle font-22 avatar-title text-white"></i>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">127</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Messages</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <div class="float-right d-inline-block">
                                <div class="btn-group mb-2">
                                    <button type="button" class="btn btn-xs btn-light">Today</button>
                                    <button type="button" class="btn btn-xs btn-light">Weekly</button>
                                    <button type="button" class="btn btn-xs btn-secondary">Monthly</button>
                                </div>
                            </div>
                            <h4 class="header-title mb-3">Messages</h4>
                            <div dir="ltr">
                                <div id="sales-analytics" class="mt-4" data-colors="#ff7804,#cb5e00"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card-box">
                        <h4 class="header-title mb-3">Recent Users </h4>
                        <div class="table-responsive">
                            <table class="table table-borderless table-hover table-nowrap table-centered m-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width: 36px;">
                                            <img src="{{ asset('assets/admin/images/users/user-1.jpg') }}" alt="" class="rounded-circle avatar-sm" />
                                        </td>
                                        <td>
                                            <h5 class="m-0 font-weight-normal">Adelmo</h5>
                                        </td>
                                        <td>
                                            adelmo@gmail.com
                                        </td>
                                        <td>
                                            <a href="edituser.php" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
                                            <a href="javascript: void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-popup"><i class="mdi mdi-trash-can"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 36px;">
                                            <img src="{{ asset('assets/admin/images/users/user-2.jpg') }}" alt="" class="rounded-circle avatar-sm" />
                                        </td>
                                        <td>
                                            <h5 class="m-0 font-weight-normal">John Smith</h5>
                                        </td>
                                        <td>
                                            johnsmith@gmail.com
                                        </td>
                                        <td>
                                            <a href="edituser.php" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
                                            <a href="javascript: void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-popup"><i class="mdi mdi-trash-can"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 36px;">
                                            <img src="{{ asset('assets/admin/images/users/user-4.jpg') }}" alt="" class="rounded-circle avatar-sm" />
                                        </td>
                                        <td>
                                            <h5 class="m-0 font-weight-normal">David Smith</h5>
                                        </td>
                                        <td>
                                            davidsmith@gmail.com
                                        </td>
                                        <td>
                                            <a href="edituser.php" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
                                            <a href="javascript: void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-popup"><i class="mdi mdi-trash-can"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 36px;">
                                            <img src="{{ asset('assets/admin/images/users/user-5.jpg') }}" alt="" class="rounded-circle avatar-sm" />
                                        </td>
                                        <td>
                                            <h5 class="m-0 font-weight-normal">Steve Smith</h5>
                                        </td>
                                        <td>
                                            stevesmith@gmail.com
                                        </td>
                                        <td>
                                            <a href="edituser.php" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
                                            <a href="javascript: void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-popup"><i class="mdi mdi-trash-can"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 36px;">
                                            <img src="{{ asset('assets/admin/images/users/user-6.jpg') }}" alt="" class="rounded-circle avatar-sm" />
                                        </td>
                                        <td>
                                            <h5 class="m-0 font-weight-normal">Andrew Ainsley</h5>
                                        </td>
                                        <td>
                                            andrew_ainsley@gmail.com
                                        </td>
                                        <td>
                                            <a href="edituser.php" class="btn btn-xs btn-success"><i class="mdi mdi-pencil"></i></a>
                                            <a href="javascript: void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-popup"><i class="mdi mdi-trash-can"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-box">
                        <h4 class="header-title mb-3">Recent Messages </h4>
                        <div class="table-responsive">
                            <table id="basic-datatable" class="table table-borderless table-hover table-nowrap table-centered m-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Contact</th>
                                        <th>Type</th>
                                        <th>Count</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h5 class="m-0 font-weight-normal">+1234 567 890</h5>
                                        </td>
                                        <td>
                                            1 - on - 1
                                        </td>
                                        <td>
                                            <span class="badge badge-light">5</span>
                                        </td>
                                        <td>
                                            11/12/2022, 5:54:26 PM
                                        </td>
                                        <td>
                                            <a href="chat.php" class="btn btn-xs btn-primary"><i class="mdi mdi-message"></i> Chat</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="m-0 font-weight-normal">+1234 567 890</h5>
                                        </td>
                                        <td>
                                            Group
                                        </td>
                                        <td>
                                            <span class="badge badge-light">11</span>
                                        </td>
                                        <td>
                                            07/10/2022, 2:12:26 PM
                                        </td>
                                        <td>
                                            <a href="chat.php" class="btn btn-xs btn-primary"><i class="mdi mdi-message"></i> Chat</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="m-0 font-weight-normal">+1234 567 890</h5>
                                        </td>
                                        <td>
                                            1 - on - 1
                                        </td>
                                        <td>
                                            <span class="badge badge-light">7</span>
                                        </td>
                                        <td>
                                            01/10/2022, 3:54:26 AM
                                        </td>
                                        <td>
                                            <a href="chat.php" class="btn btn-xs btn-primary"><i class="mdi mdi-message"></i> Chat</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="m-0 font-weight-normal">+1234 567 890</h5>
                                        </td>
                                        <td>
                                            Group
                                        </td>
                                        <td>
                                            <span class="badge badge-light">1</span>
                                        </td>
                                        <td>
                                            29/11/2022, 3:54:26 AM
                                        </td>
                                        <td>
                                            <a href="chat.php" class="btn btn-xs btn-primary"><i class="mdi mdi-message"></i> Chat</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="m-0 font-weight-normal">+1234 567 890</h5>
                                        </td>
                                        <td>
                                            1 - on - 1
                                        </td>
                                        <td>
                                            <span class="badge badge-light">3</span>
                                        </td>
                                        <td>
                                            11/10/2022, 3:54:26 AM
                                        </td>
                                        <td>
                                            <a href="chat.php" class="btn btn-xs btn-primary"><i class="mdi mdi-message"></i> Chat</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5 class="m-0 font-weight-normal">+1234 567 890</h5>
                                        </td>
                                        <td>
                                            Group
                                        </td>
                                        <td>
                                            <span class="badge badge-light">11</span>
                                        </td>
                                        <td>
                                            07/10/2022, 2:12:26 PM
                                        </td>
                                        <td>
                                            <a href="chat.php" class="btn btn-xs btn-primary"><i class="mdi mdi-message"></i> Chat</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.layout.footer')
        </div>
    </div>
</div>
@endsection