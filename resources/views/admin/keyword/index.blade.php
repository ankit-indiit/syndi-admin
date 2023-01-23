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
                                <li class="breadcrumb-item active">Keywords</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Keywords</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="header-title mb-3">All Keywords </h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="javascript:void(0)" class="btn btn-primary  mb-3" data-toggle="modal" data-target="#keyword_modal">Add Keyword</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="basic-datatable_length">
                                            <label>
                                                Show 
                                                <select name="basic-datatable_length" aria-controls="basic-datatable" class="custom-select custom-select-sm form-control form-control-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                                entries
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="basic-datatable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="basic-datatable"></label></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="basic-datatable" class="table table-borderless table-hover table-nowrap table-centered m-0 dataTable no-footer" role="grid" aria-describedby="basic-datatable_info">
                                            <thead class="thead-light">
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Keyword: activate to sort column descending" style="width: 178.5px;">Keyword</th>
                                                    <th class="sorting" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-label="Added By: activate to sort column ascending" style="width: 187.719px;">Added By</th>
                                                    <th class="sorting" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-label="Reply Count: activate to sort column ascending" style="width: 183.953px;">Reply Count</th>
                                                    <th class="sorting" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 118.672px;">Status</th>
                                                    <th class="sorting" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 122.188px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">
                                                        <h5 class="m-0 font-weight-normal">Demo</h5>
                                                    </td>
                                                    <td>
                                                        John Smith
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light">7</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-soft-success">Active</span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-success" data-toggle="modal" data-target="#editkeyword_modal"><i class="mdi mdi-pencil"></i></a>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-popup"><i class="mdi mdi-trash-can"></i></a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="even">
                                                    <td class="sorting_1">
                                                        <h5 class="m-0 font-weight-normal">Demo</h5>
                                                    </td>
                                                    <td>
                                                        Andrew Ainsley
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light">1</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-soft-success">Active</span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-success" data-toggle="modal" data-target="#editkeyword_modal"><i class="mdi mdi-pencil"></i></a>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-popup"><i class="mdi mdi-trash-can"></i></a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">
                                                        <h5 class="m-0 font-weight-normal">Demo User</h5>
                                                    </td>
                                                    <td>
                                                        Steve Smith
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light">3</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-soft-success">Active</span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-success" data-toggle="modal" data-target="#editkeyword_modal"><i class="mdi mdi-pencil"></i></a>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-popup"><i class="mdi mdi-trash-can"></i></a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="even">
                                                    <td class="sorting_1">
                                                        <h5 class="m-0 font-weight-normal">Designing</h5>
                                                    </td>
                                                    <td>
                                                        Steve Smith
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light">5</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-soft-danger">Inactive</span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-success" data-toggle="modal" data-target="#editkeyword_modal"><i class="mdi mdi-pencil"></i></a>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-popup"><i class="mdi mdi-trash-can"></i></a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">
                                                        <h5 class="m-0 font-weight-normal">Development</h5>
                                                    </td>
                                                    <td>
                                                        John Smith
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light">0</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-soft-danger">Inactive</span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-success" data-toggle="modal" data-target="#editkeyword_modal"><i class="mdi mdi-pencil"></i></a>
                                                        <a href="javascript: void(0);" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-popup"><i class="mdi mdi-trash-can"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="basic-datatable_info" role="status" aria-live="polite">Showing 1 to 5 of 5 entries</div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="basic-datatable_paginate">
                                            <ul class="pagination pagination-rounded">
                                                <li class="paginate_button page-item previous disabled" id="basic-datatable_previous"><a href="#" aria-controls="basic-datatable" data-dt-idx="0" tabindex="0" class="page-link"><i class="mdi mdi-chevron-left"></i></a></li>
                                                <li class="paginate_button page-item active"><a href="#" aria-controls="basic-datatable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                                <li class="paginate_button page-item next disabled" id="basic-datatable_next"><a href="#" aria-controls="basic-datatable" data-dt-idx="2" tabindex="0" class="page-link"><i class="mdi mdi-chevron-right"></i></a></li>
                                            </ul>
                                        </div>
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
<div class="modal delete_modal fade" id="delete-popup" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="delete-cont">
                    <i class="far fa-times-circle"></i>
                    <h3>Are you sure?</h3>
                    <p>Are you sure you want to delete this record? This process cannot be undone</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>
<div class="modal modal_keyword fade" id="keyword_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="headsub">Add Keyword</h4>
                <form>
                    <div class="form-group">
                        <label for="Keyword">Keyword</label>
                        <input type="text" id="Keyword" class="form-control" placeholder="Enter Keyword" value="" >
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div class="input-group">
                            <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                            </label>                                                            
                        </div>
                    </div>
                    <div class="text-end mt-4">
                        <button type="button" class="btn btn-primary waves-effect waves-light">Save</button>
                        <button type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal modal_keyword fade" id="editkeyword_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <h4 class="headsub">Add Keyword</h4>
                <form>
                    <div class="form-group">
                        <label for="Keyword">Keyword</label>
                        <input type="text" id="Keyword" class="form-control" placeholder="Enter Keyword" value="Demo" >
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div class="input-group">
                            <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                            </label>                                                            
                        </div>
                    </div>
                    <div class="text-end mt-4">
                        <button type="button" class="btn btn-primary waves-effect waves-light">Save</button>
                        <button type="button" class="btn btn-light waves-effect waves-light" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection