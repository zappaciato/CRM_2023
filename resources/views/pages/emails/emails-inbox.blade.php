<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/sweetalerts2/sweetalerts2.css')}}">
        @vite(['resources/scss/light/assets/components/modal.scss'])
        @vite(['resources/scss/light/plugins/editors/quill/quill.snow.scss'])
        @vite(['resources/scss/light/assets/apps/mailbox.scss'])
        @vite(['resources/scss/light/plugins/sweetalerts2/custom-sweetalert.scss'])

        @vite(['resources/scss/dark/assets/components/modal.scss'])
        @vite(['resources/scss/dark/plugins/editors/quill/quill.snow.scss'])
        @vite(['resources/scss/dark/assets/apps/mailbox.scss'])
        @vite(['resources/scss/dark/plugins/sweetalerts2/custom-sweetalert.scss'])
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12">

            <div class="row">

                <div class="col-xl-12  col-md-12">

                    <div class="mail-box-container">

                        <div class="mail-overlay"></div>

                        {{-- taby do emaili --}}
                        <div class="tab-title">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12 text-center mail-btn-container">
                                    <a id="btn-compose-mail" class="btn btn-block" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></a>
                                </div>
                                <div class="col-md-12 col-sm-12 col-12 mail-categories-container">

                                    <div class="mail-sidebar-scroll">

                                        <ul class="nav nav-pills d-block" id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link list-actions active" id="mailInbox"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg> <span class="nav-names">Inbox</span> <span class="mail-badge badge"></span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list-actions" id="important"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg> <span class="nav-names">Important</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list-actions" id="draft"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg> <span class="nav-names">Draft</span> <span class="mail-badge badge"></span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list-actions" id="sentmail"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg> <span class="nav-names"> Sent Mail</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list-actions" id="spam"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg> <span class="nav-names">Spam</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list-actions" id="trashed"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> <span class="nav-names">Trash</span></a>
                                            </li>
                                        </ul>

                                        <p class="group-section"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg> Groups</p>

                                        <ul class="nav nav-pills d-block group-list" id="pills-tab2" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link list-actions active g-dot-primary" id="personal"><span>Personal</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list-actions g-dot-warning" id="work"><span>Work</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list-actions g-dot-success" id="social"><span>Social</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list-actions g-dot-danger" id="private"><span>Private</span></a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
{{-- end taby do emaili --}}
                        <div id="mailbox-inbox" class="accordion mailbox-inbox">

                            <div class="search">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu mail-menu d-lg-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                                <input type="text" class="form-control input-search" placeholder="Search Here...">
                            </div>

                            <div class="action-center">
                                <div class="">
                                    <div class="form-check form-check-primary form-check-inline mt-1" data-bs-toggle="collapse" data-bs-target>
                                        <input class="form-check-input inbox-chkbox" type="checkbox" id="inboxAll">
                                    </div>
                                </div>

                                <div class="">
                                    <a class="nav-link dropdown-toggle d-icon label-group" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" data-toggle="tooltip" data-placement="top" data-original-title="Label" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg></a>
                                    <div class="dropdown-menu left d-icon-menu">
                                        <a class="label-group-item label-personal dropdown-item position-relative g-dot-primary" href="javascript:void(0);"> Personal</a>
                                        <a class="label-group-item label-work dropdown-item position-relative g-dot-warning" href="javascript:void(0);"> Work</a>
                                        <a class="label-group-item label-social dropdown-item position-relative g-dot-success" href="javascript:void(0);"> Social</a>
                                        <a class="label-group-item label-private dropdown-item position-relative g-dot-danger" href="javascript:void(0);"> Private</a>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" data-toggle="tooltip" data-placement="top" data-original-title="Important" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star action-important"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-toggle="tooltip" data-placement="top" data-original-title="Spam" class="feather feather-alert-circle action-spam"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" data-toggle="tooltip" data-placement="top" data-original-title="Revive Mail" stroke-linejoin="round" class="feather feather-activity revive-mail"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-toggle="tooltip" data-placement="top" data-original-title="Delete Permanently" class="feather feather-trash permanent-delete"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    <div class="dropdown d-inline-block more-actions">
                                        <a class="nav-link dropdown-toggle" id="more-actions-btns-dropdown" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="more-actions-btns-dropdown">
                                            <a class="dropdown-item action-mark_as_read" href="javascript:void(0);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg> Mark as Read
                                            </a>
                                            <a class="dropdown-item action-mark_as_unRead" href="javascript:void(0);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg> Mark as Unread
                                            </a>
                                            <a class="dropdown-item action-delete" href="javascript:void(0);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg> Trash
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                    
                            <div class="message-box">
                                
                                <div class="message-box-scroll" id="ct">
{{-- list of emails --}}
@foreach($emails as $email)
                                    <div id="unread-promotion-page" class="mail-item mailInbox">
                                        <div class="animated animatedFadeInUp fadeInUp" id="mailHeadingThree">
                                            <div class="mb-0">
                                                <div class="mail-item-heading social collapsed"  data-bs-toggle="collapse" role="navigation" data-bs-target="#mailCollapse{{$email->id}}" aria-expanded="false">

                                                    <div class="mail-item-inner">

                                                        <div class="d-flex">
                                                            <div class="form-check form-check-primary form-check-inline mt-1" data-bs-toggle="collapse" data-bs-target>
                                                                <input class="form-check-input inbox-chkbox" type="checkbox" id="form-check-default3">
                                                            </div>
                                                            <div class="f-head">
                                                                <img src="{{Vite::asset('resources/images/profile-16.jpeg')}}" class="user-profile" alt="avatar">
                                                            </div>
                                                            <div class="f-body">
                                                                <div class="meta-mail-time">
                                                                    <p class="user-email" data-mailTo="laurieFox@mail.com">{{$email->sender}}</p>
                                                                </div>
                                                                <div class="meta-title-tag">
                                                                    <p class="mail-content-excerpt" data-mailDescription='{"ops":[{"insert":"Lorem .....'><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip attachment-indicator"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg><span class="mail-title" data-mailTitle="{{$email->title}}">{{$email->title}} - </span> {{$email->content}}
                                                                    </p>
                                                                    <div class="tags">
                                                                        <span class="g-dot-primary"></span>
                                                                        <span class="g-dot-warning"></span>
                                                                        <span class="g-dot-success"></span>
                                                                        <span class="g-dot-danger"></span>
                                                                    </div>
                                                                    <p class="meta-time align-self-center">2:00 PM</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="attachments">
                                                        <span class="">Confirm File.txt</span>
                                                        <span class="">Important Docs.xml</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
@endforeach
                                </div>
                            </div>
{{-- individual email content section --}}
                            <div class="content-box">
                                <div class="d-flex msg-close">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left close-message"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                                    {{-- <h2 class="mail-title" data-selectedMailTitle="">{{$email->title}}</h2> --}}
                                    <h2  >{{$email->title}}</h2>
                                    
                                </div>

                                


@foreach($emails as $email)

                                <div id="mailCollapse{{$email->id}}" class="collapse" aria-labelledby="mailHeadingThree" data-bs-parent="#mailbox-inbox">
                                    <div class="mail-content-container mailInbox" data-mailfrom="info@mail.com" data-mailto="linda@mail.com" data-mailcc="">

                                        <div class="d-flex justify-content-between">

                                            <div class="d-flex user-info">
                                                <div class="f-head">
                                                    <img src="{{Vite::asset('resources/images/profile-16.jpeg')}}" class="user-profile" alt="avatar">
                                                </div>
                                                <div class="f-body">
                                                    <div class="meta-title-tag">
                                                        <h4 class="mail-usr-name" data-mailtitle="{{$email->title}}">{{$email->sender}}</h4>
                                                        
                                                    </div>
                                                    
                                                    <div class="meta-mail-time">
                                                        <p class="user-email" data-mailto="laurieFox@mail.com">{{$email->email}}</p>
                                                        <p class="mail-content-meta-date current-recent-mail">{{$email->date}} -</p>
                                                        <p class="meta-time align-self-center">2:00 PM</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="action-btns">
                                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-original-title="Reply">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-left reply"><polyline points="9 14 4 9 9 4"></polyline><path d="M20 20v-7a4 4 0 0 0-4-4H4"></path></svg>
                                                </a>
                                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-original-title="Forward">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-right forward"><polyline points="15 14 20 9 15 4"></polyline><path d="M4 20v-7a4 4 0 0 1 4-4h12"></path></svg>
                                                </a>
                                            </div>
                                        </div>

                                        <a href=""><button class="btn btn-danger ms-5">Utwórz zlecenie z emaila</button></a>
                                        <a href=""><button class="btn btn-warning ms-5">Usuń emaila</button></a>

                                        


                                        <p class="mail-content" data-mailTitle="Promotion Page" data-maildescription='{"ops":[{"insert":"Lorem .....\n"}]}'> {{$email->content}} </p>

                                        <div class="gallery text-center">
                                            <img alt="image-gallery" src="{{Vite::asset('resources/images/scroll-6.jpeg')}}" class="img-fluid mb-4 mt-4" style="width: 250px; height: 180px;">
                                        </div>

                                        <p>{{$email->content}}</p>



                                        <div class="attachments">
                                            <h6 class="attachments-section-title">Załączniki</h6>
                                            <div class="attachment file-pdf">
                                                <div class="media">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                    <div class="media-body">
                                                        <p class="file-name">Confirm File.txt</p>
                                                        <p class="file-size">450kb</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="attachment file-folder">
                                                <div class="media">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                    <div class="media-body">
                                                        <p class="file-name">Important Docs.xml</p>
                                                        <p class="file-size">2.1MB</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
@endforeach


                               
                            </div>

                        </div>
                        
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="composeMailModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title add-title" id="notesMailModalTitleeLabel">Compose</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-bs-dismiss="modal"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> -->
                                    <div class="compose-box">
                                        <div class="compose-content">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-4 mail-form">
                                                            <p>From:</p>
                                                            <select class="form-control" id="m-form">
                                                                <option value="info@mail.com">Info &lt;info@mail.com&gt;</option>
                                                                <option value="shaun@mail.com">Shaun Park &lt;shaun@mail.com&gt;</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-4 mail-to">
                                                            <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> To:</p>
                                                            <div class="">
                                                                <input type="email" id="m-to" class="form-control">
                                                                <span class="validation-text"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-4 mail-cc">
                                                            <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg> CC:</p>
                                                            <div>
                                                                <input type="text" id="m-cc" class="form-control">
                                                                <span class="validation-text"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-4 mail-subject">
                                                    <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> Subject:</p>
                                                    <div class="w-100">
                                                        <input type="text" id="m-subject" class="form-control">
                                                        <span class="validation-text"></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="">
                                                    <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> Upload Attachment:</p>
                                                    <!-- <input type="file" class="form-control-file" id="mail_File_attachment" multiple="multiple"> -->
                                                    <input class="form-control file-upload-input" type="file" id="formFile" multiple="multiple">
                                                </div>

                                                <div id="editor-container">

                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="btn-save" class="btn float-left btn-success"> Save</button>
                                    <button id="btn-reply-save" class="btn float-left btn-success"> Save Reply</button>
                                    <button id="btn-fwd-save" class="btn float-left btn-success"> Save Fwd</button>

                                    <button class="btn" data-bs-dismiss="modal"> <i class="flaticon-delete-1"></i> Discard</button>

                                    <button id="btn-reply" class="btn btn-primary"> Reply</button>
                                    <button id="btn-fwd" class="btn btn-primary"> Forward</button>
                                    <button id="btn-send" class="btn btn-primary"> Send</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>

        </div>
    </div>
    
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script src="{{asset('plugins/global/vendors.min.js')}}"></script>
        <script src="{{asset('plugins/editors/quill/quill.js')}}"></script>
        <script src="{{asset('plugins/sweetalerts2/sweetalerts2.min.js')}}"></script>
        <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
        @vite(['resources/assets/js/apps/mailbox.js'])
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>