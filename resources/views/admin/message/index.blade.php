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
                        <li class="breadcrumb-item active">Messages</li>
                     </ol>
                  </div>
                  <h4 class="page-title">Messages</h4>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12">
               <div class="card-box">
                  <div class="row">
                     <div class="col-md-12">
                        <h4 class="header-title mb-3">All Messages </h4>
                     </div>
                  </div>
                  <div class="table-responsive">
                   <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="basic-datatable_length"><label>Show <select name="basic-datatable_length" aria-controls="basic-datatable" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="basic-datatable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="basic-datatable"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="basic-datatable" class="table table-borderless table-hover table-nowrap table-centered m-0 dataTable no-footer" role="grid" aria-describedby="basic-datatable_info">
                      <thead class="thead-light">
                         <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Contact: activate to sort column descending" style="width: 187.047px;">Contact</th><th class="sorting" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-label="Type: activate to sort column ascending" style="width: 99.1562px;">Type</th><th class="sorting" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-label="Count: activate to sort column ascending" style="width: 111.953px;">Count</th><th class="sorting" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-label="Date: activate to sort column ascending" style="width: 273.734px;">Date</th><th class="sorting" tabindex="0" aria-controls="basic-datatable" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 119.141px;">Action</th></tr>
                      </thead>
                      <tbody>
                        
                        
                        
                        
                        
                      <tr role="row" class="odd">
                            <td class="sorting_1">
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
                                <a href="{{ route('message.show', 1) }}" class="btn btn-xs btn-primary"><i class="mdi mdi-message"></i> Chat</a>
                            </td>
                        </tr><tr role="row" class="even">
                            <td class="sorting_1">
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
                                <a href="{{ route('message.show', 1) }}" class="btn btn-xs btn-primary"><i class="mdi mdi-message"></i> Chat</a>
                            </td>
                        </tr><tr role="row" class="odd">
                            <td class="sorting_1">
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
                                <a href="{{ route('message.show', 1) }}" class="btn btn-xs btn-primary"><i class="mdi mdi-message"></i> Chat</a>
                            </td>
                        </tr><tr role="row" class="even">
                            <td class="sorting_1">
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
                                <a href="{{ route('message.show', 1) }}" class="btn btn-xs btn-primary"><i class="mdi mdi-message"></i> Chat</a>
                            </td>
                        </tr><tr role="row" class="odd">
                            <td class="sorting_1">
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
                                <a href="{{ route('message.show', 1) }}" class="btn btn-xs btn-primary"><i class="mdi mdi-message"></i> Chat</a>
                            </td>
                        </tr></tbody>
                   </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="basic-datatable_info" role="status" aria-live="polite">Showing 1 to 5 of 5 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="basic-datatable_paginate"><ul class="pagination pagination-rounded"><li class="paginate_button page-item previous disabled" id="basic-datatable_previous"><a href="#" aria-controls="basic-datatable" data-dt-idx="0" tabindex="0" class="page-link"><i class="mdi mdi-chevron-left"></i></a></li><li class="paginate_button page-item active"><a href="#" aria-controls="basic-datatable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="basic-datatable_next"><a href="#" aria-controls="basic-datatable" data-dt-idx="2" tabindex="0" class="page-link"><i class="mdi mdi-chevron-right"></i></a></li></ul></div></div></div></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   @include('admin.layout.footer')
</div>
@endsection
    