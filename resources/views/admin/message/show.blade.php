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
                        <li class="breadcrumb-item"><a href="{{ route('message.index') }}">Chats</a></li>
                        <li class="breadcrumb-item active">View Chat</li>
                     </ol>
                  </div>
                  <h4 class="page-title">View Chat</h4>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <form class="search-bar mb-3">
                            <div class="position-relative">
                                <input type="text" class="form-control form-control-light" placeholder="Search...">
                                <span class="mdi mdi-magnify"></span>
                            </div>
                        </form>
                        <h6 class="font-13 text-muted text-uppercase mb-2">Contacts</h6>
                        <div class="row">
                            <div class="col">
                                <div data-simplebar="init" style="max-height: 375px"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px;">
                                    <a href="javascript:void(0);" class="text-body">
                                        <div class="media p-2">
                                            <div class="media-body">
                                                <h5 class="mt-0 mb-0 font-14">
                                                    <span class="float-right text-muted font-weight-normal font-12">4:30am</span>
                                                    +1234 567 890
                                                </h5>
                                                <p class="mt-1 mb-0 text-muted font-14">
                                                    <span class="w-25 float-right text-right"><span class="badge badge-soft-danger">3</span></span>
                                                    <span class="w-75">Lorem Ipsum is simply dummy text</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0);" class="text-body">
                                        <div class="media p-2">
                                            <div class="media-body">
                                                <h5 class="mt-0 mb-0 font-14">
                                                    <span class="float-right text-muted font-weight-normal font-12">5:30am</span>
                                                    +1234 567 890
                                                </h5>
                                                <p class="mt-1 mb-0 text-muted font-14">
                                                    <span class="w-75">Lorem Ipsum is simply dummy text</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0);" class="text-body">
                                        <div class="media p-2">
                                            <div class="media-body">
                                                <h5 class="mt-0 mb-0 font-14">
                                                    <span class="float-right text-muted font-weight-normal font-12">Thu</span>
                                                    John Smith
                                                </h5>
                                                <p class="mt-1 mb-0 text-muted font-14">
                                                    <span class="w-25 float-right text-right"><span class="badge badge-soft-danger">2</span></span>
                                                    <span class="w-75">Lorem Ipsum is simply dummy text</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0);" class="text-body">
                                        <div class="media bg-light p-2">
                                            <div class="media-body">
                                                <h5 class="mt-0 mb-0 font-14">
                                                    <span class="float-right text-muted font-weight-normal font-12">Wed</span>
                                                    +1234 567 890
                                                </h5>
                                                <p class="mt-1 mb-0 text-muted font-14">
                                                    <span class="w-75">Lorem Ipsum is simply dummy text</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0);" class="text-body">
                                        <div class="media p-2">
                                            <div class="media-body">
                                                <h5 class="mt-0 mb-0 font-14">
                                                    <span class="float-right text-muted font-weight-normal font-12">Tue</span>
                                                    Andrew Ainsley
                                                </h5>
                                                <p class="mt-1 mb-0 text-muted font-14">
                                                    <span class="w-75">Lorem Ipsum is simply dummy text</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0);" class="text-body">
                                        <div class="media p-2">
                                            <div class="media-body">
                                                <h5 class="mt-0 mb-0 font-14">
                                                    <span class="float-right text-muted font-weight-normal font-12">Tue</span>
                                                    +1234 567 890
                                                </h5>
                                                <p class="mt-1 mb-0 text-muted font-14">
                                                    <span class="w-75">Lorem Ipsum is simply dummy text</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0);" class="text-body">
                                        <div class="media p-2">
                                            <div class="media-body">
                                                <h5 class="mt-0 mb-0 font-14">
                                                    <span class="float-right text-muted font-weight-normal font-12">Tue</span>
                                                    +1234 567 890
                                                </h5>
                                                <p class="mt-1 mb-0 text-muted font-14">
                                                    <span class="w-75">Lorem Ipsum is simply dummy text</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0);" class="text-body">
                                        <div class="media p-2">
                                            <div class="media-body">
                                                <h5 class="mt-0 mb-0 font-14">
                                                    <span class="float-right text-muted font-weight-normal font-12">Mon</span>
                                                        +1234 567 890
                                                </h5>
                                                <p class="mt-1 mb-0 text-muted font-14">
                                                    <span class="w-75">Lorem Ipsum is simply dummy text</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>

                                </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 573px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 245px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div> 
                            </div> 
                        </div>
                    </div>
                </div> 
            </div>
            
            <div class="col-xl-9 col-lg-8">

                <div class="card">
                    <div class="card-body py-2 px-3 border-bottom border-light">
                        <div class="media py-1">
                            <div class="media-body">
                                <h5 class="mt-0 mb-0 font-15">
                                    <a href="#" class="text-reset">+1234 567 890</a>
                                </h5>
                                <p class="mt-1 mb-0 text-muted font-12">
                                    <small class="mdi mdi-circle text-success"></small> Online
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="conversation-list" data-simplebar="init" style="max-height: 460px"><div class="simplebar-wrapper" style="margin: 0px -15px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px 15px;">
                            <li class="clearfix">
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <p>
                                            Hello!
                                        </p>
                                    </div>
                                </div>
                                <p>10:00</p>
                            </li>
                            <li class="clearfix odd">
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <p>
                                            Hi, How are you? What about our next meeting?
                                        </p>
                                    </div>
                                </div>
                                <p>10:01</p>
                              
                            </li>
                            <li class="clearfix">
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <p>
                                            Yeah everything is fine
                                        </p>
                                    </div>
                                </div>
                               <p>10:01</p>
                            </li>
                            <li class="clearfix odd">
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <p>
                                            Wow that's great
                                        </p>
                                    </div>
                                </div>
                                <p>10:02</p>
                            </li>
                            <li class="clearfix">
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <p>
                                            Let's have it today if you are free
                                        </p>
                                    </div>
                                </div>
                                <p>10:02</p>
                            </li>
                            <li class="clearfix odd">
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <p>
                                            Sure thing! let me know if 2pm works for you
                                        </p>
                                    </div>
                                </div>
                                <p>10:03</p>
                            </li>
                            <li class="clearfix">
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <p>
                                            Sorry, I have another meeting scheduled at 2pm. Can we have it
                                            at 3pm instead?
                                        </p>
                                    </div>
                                </div>
                                <p>10:04</p>
                            </li>
                            <li class="clearfix">
                                <div class="conversation-text">
                                    <div class="ctext-wrap">
                                        <p>
                                            We can also discuss about the presentation talk format if you have some extra mins
                                        </p>
                                    </div>
                                </div>
                                <p>10:04</p>
                            </li>
                          
                        </div></div></div></div><div class="simplebar-placeholder" style="width: auto; height: 804px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 263px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
   @include('admin.layout.footer')
</div>
</div>
@endsection
        