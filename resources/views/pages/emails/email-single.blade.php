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

    

    

<div id="mailCollapseThree" class="p-5" aria-labelledby="mailHeadingThree" data-bs-parent="#mailbox-inbox">
                                    <div class="mail-content-container mailInbox" data-mailfrom="info@mail.com" data-mailto="linda@mail.com" data-mailcc="">

      
            @if($contactPerson == false)
<div style="background-color: pink" class="card p-2 d-flex"><h3>Uwaga!</h3><h5>Kontakt poza bazą danych!</h5><h6>Upewnij się, że kontakt istnieje w bazie zanim utworzysz zgłoszenie.</h6>
    <a href="{{route('contact.add')}}"><button class="btn btn-success">Dodaj kontakt</button></a>
</div>
        @endif
     
                                        <div class="d-flex justify-content-between">

                                            <div class="d-flex user-info">
                                                <div class="f-head me-2">
                                                    <img src="{{Vite::asset('resources/images/profile-16.jpeg')}}" class="user-profile" alt="avatar">
                                                </div>
                                                <div class="f-body border-bottom border-info">
                                                    <div class="meta-title-tag">
                                                        <h4 class="mail-usr-name" data-mailtitle="Promotion Page">{{$email->from_name}}</h4>
                                                    </div>
                                                    <div class="meta-mail-time">
                                                        <p class="user-email" data-mailto="laurieFox@mail.com">{{$email->from_address}}</p>
                                                        <p class="mail-content-meta-date current-recent-mail">{{$email->date}}</p>
                                                        <p class="meta-time align-self-center">{{$email->date}}</p>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            {{-- email subject --}}
                                            <div class="container d-flex justify-content-center align-items-end border-bottom border-danger mt-6 p-2 ms-5 me-5">
                                            <div class="container d-flex justify-content-evenly "><h4>Tytuł:</h4></div>
                                            <div class="container d-flex justify-content-between "><h4>"{{$email->subject}}"</h4></div>
                                            </div>
                                            
                                            
                                            {{-- end email subject --}}

                                            <div class="action-btns">
                                                
                                                <a href="{{route('email.inbox')}}" data-toggle="tooltip" data-placement="top" data-original-title="Reply">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-left reply"><polyline points="9 14 4 9 9 4"></polyline><path d="M20 20v-7a4 4 0 0 0-4-4H4"></path></svg>
                                                </a>
                                                {{-- <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-original-title="Forward">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-right forward"><polyline points="15 14 20 9 15 4"></polyline><path d="M4 20v-7a4 4 0 0 1 4-4h12"></path></svg>
                                                </a> --}}
                                            </div>
                                            
                                        </div>


                                        <div class="email-content-display-wrapper">
                                            <div class="">
                                        <h1 
                                            class="email-content-display" 
                                            data-mailTitle="{{$email->subject}}" 
                                            data-maildescription='{"ops":[{"insert":"{{$email->text_plain}}"}]}'> 
                                                                                        
                                            {!!$email->text_html!!}

                                        </h1>
                                        </div>
                                        {{-- $eflag == false if there is a match of email if with email_id in emailsToOrders --}}
                                        @if($eFlag) 
                                            <div class="d-flex flex-column ">

                                            <h5>Email już przydzielony do zgłoszenia.</h5>
                                            </div>
                                        @else
                                            <div class="d-flex flex-column">
                                                <a href=""><button class="btn btn-danger custom-btn">Skasuj email</button></a>
                                                <a href=""><button class="btn btn-warning mt-2 custom-btn">Przenieś do SPAMU</button></a>
                                                @if($contactPerson == false)
                                                
                                                <a aria-disabled="true" ><button class="btn btn-dark text-dark mt-4 custom-btn">NOWE zgłoszenie z emaila</button></a>
                                                <p>Przycisk niedostępny! </p>

                                                @else
                                                <a href="{{route('create.order.email', $email->id)}}" ><button class="btn btn-success mt-4 custom-btn">NOWE zgłoszenie z emaila</button></a>
                                                @endif
                                                {{-- this triggers modal "addtoorder" --}}

                                                <button class="btn btn-success mt-4 custom-btn" data-bs-toggle="modal" data-bs-target="#modaladd2order">Dodaj do istniejacego zgłoszenia</button>
                                            </div>
                                        @endif
                                        </div>
                                        {{-- This assigns email to order --}}
                                        @include('partials.emailpartials.email-single-modal-add2order')



                                        <div class="attachments d-flex flex-column p-5 ms-5">
                                            <h6 class="attachments-section-title">Załączniki</h6>

                                            @if($attachmentFlag == 1)

                                            @foreach($emailAttachments as $attachment)
                                       
                                            @if($attachment->collection_name === 'file#email#'.$email->id)
                                            <div class="attachment file-pdf">
                                                <div class="media">
                                                    

                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                                <div class="media-body">
                                                                <a href="{{$attachment->getUrl()}}" target="_blank"><p class="file-name">{{$attachment->name}}</p></a>
                                                                <p class="file-size">Size: {{$attachment->size}}</p>                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                            @elseif ($attachmentFlag == 0)
                                                <h5 class="text-primary">Brak załączników</h5 class="text-primary">
                                            @endif
                                                        

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