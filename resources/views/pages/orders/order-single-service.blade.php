<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
    {{-- for timeline --}}
        @vite(['resources/scss/light/assets/components/timeline.scss'])
        @vite(['resources/scss/dark/assets/components/timeline.scss'])
        <!--  END CUSTOM STYLE FILE  -->
        {{-- from post blog --}}
        @vite(['resources/scss/light/assets/elements/custom-pagination.scss'])
        @vite(['resources/scss/light/assets/apps/blog-post.scss'])
        @vite(['resources/scss/dark/assets/elements/custom-pagination.scss'])
        @vite(['resources/scss/dark/assets/apps/blog-post.scss'])
        <style>
            .toggle-code-snippet { margin-bottom: 0px; }
            body.dark .toggle-code-snippet { margin-bottom: 0px; }
        </style>
{{-- end for timeline --}}


        <link rel="stylesheet" href="{{asset('plugins/apex/apexcharts.css')}}">

        @vite(['resources/scss/light/assets/components/list-group.scss'])
        @vite(['resources/scss/light/assets/widgets/modules-widgets.scss'])

        @vite(['resources/scss/dark/assets/components/list-group.scss'])
        @vite(['resources/scss/dark/assets/widgets/modules-widgets.scss'])

        @vite(['resources/scss/light/assets/elements/alert.scss'])
        @vite(['resources/scss/dark/assets/elements/alert.scss'])

        <link rel="stylesheet" href="{{asset('plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/glightbox/glightbox.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/splide/splide.min.css')}}">

        @vite(['resources/scss/light/assets/components/tabs.scss'])
        @vite(['resources/scss/light/assets/components/accordions.scss'])
        @vite(['resources/scss/light/assets/apps/ecommerce-details.scss'])
        @vite(['resources/scss/dark/assets/components/tabs.scss'])
        @vite(['resources/scss/dark/assets/components/accordions.scss'])
        @vite(['resources/scss/dark/assets/apps/ecommerce-details.scss'])   
        <!--  END CUSTOM STYLE FILE  -->

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

    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Zlecenie nr {{$singleOrder->id}}</a></li>
            </ol>
            

            
<!-- Modal -->

 {{-- Send message modal START --}}

 
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title add-title" id="notesMailModalTitleeLabel">Utwórz wiadomość</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-bs-dismiss="modal"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> -->
                                    <div class="compose-box">
                                        <div class="compose-content">
                                            <form class="row g-3 needs-validation" action="{{route('message.to.client', $singleOrder->id)}}" method="POST" novalidate>
                                            @csrf    
                                                <input type="hidden" name="order_id" value="{{$singleOrder->id}}">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-4 mail-form">
                                                            <p>From:</p>
                                                            <select class="form-control" id="m-form" name="from">
                                                                {{-- <option value="info@mail.com">Info &lt;info@mail.com&gt;</option> --}}
                                                                <option value="{{auth()->user()->email}}">{{auth()->user()->name}} &lt;{{auth()->user()->email}} &gt;</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-4 mail-to">
                                                            <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Do:</p>
                                                            <div class="">
                                                                <input type="email" id="m-to" name="to" class="form-control" value="{{$contact->email}}">
                                                                <span class="validation-text"></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-4 mail-cc">
                                                            <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"></line><line x1="8" y1="12" x2="21" y2="12"></line><line x1="8" y1="18" x2="21" y2="18"></line><line x1="3" y1="6" x2="3" y2="6"></line><line x1="3" y1="12" x2="3" y2="12"></line><line x1="3" y1="18" x2="3" y2="18"></line></svg> CC:</p>
                                                            <div>
                                                                <input type="email" id="m-cc" name="cc" class="form-control" value="{{$company->email}}">
                                                                <span class="validation-text"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-4 mail-subject">
                                                    <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> Temat:</p>
                                                    <div class="w-100">
                                                        <input type="text" id="m-subject" name="subject" class="form-control" value="ZgłoszenieNr: #{{$singleOrder->id}}# {{$singleOrder->title}}">
                                                        <span class="validation-text"></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-5">
                                                    <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> Załączniki:</p>
                                                    <!-- <input type="file" class="form-control-file" id="mail_File_attachment" multiple="multiple"> -->
                                                    <input class="form-control file-upload-input" type="file" id="formFile" multiple="multiple">
                                                </div>

                                                <div class="message-content">
                                                     <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> Treść:</p>
                                                    <textarea  class="" name="content" id="message-content" cols="58" rows="10" >Wiadomość odnosi sie do zgłoszenia: {{$singleOrder->title}}</textarea>
                                                </div>

                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="btn-save" class="btn float-left btn-success"> Zapisz</button>
                                    <button class="btn" data-bs-dismiss="modal"> <i class="flaticon-delete-1"></i> Anuluj</button>
                                    <button type="submit" value="submit" id="btn-send" class="btn btn-primary"> Wyślij</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Send message modal END --}}

        </nav>

        <div class="d-flex justify-content-between">

            <div class="d-flex ">
            <a href="{{route('service.orders')}}"><button class="btn btn-success btn-lg">Wróć do listy zgłoszeń</button></a>
            <a href="{{route('single.service.order.edit', $singleOrder->id)}}"><button class="btn btn-warning ms-5 btn-lg">Edytuj zgłoszenie</button></a>
            <button type="button" class="btn btn-info btn-lg cancel-btn ms-5" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Wyślij wiadomość do klienta</button>
            </div>

            <div class="d-flex">
            {{-- order cancellation with one button --}}
            <form method="POST" action="{{route('cancel.order', $singleOrder->id)}}">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="status" value="anulowane">

            <button type="submit" class="btn btn-dark btn-lg cancel-btn">Anuluj zgłoszenie</button>
            </form>

            

            {{-- delete order --}}
            <form method="POST" action="{{route('single.service.order.delete', $singleOrder->id)}}">
                @csrf
                {{method_field('DELETE')}} 
                <button class="btn btn-danger ms-5 btn-lg delete-btn" onclick="return confirm('Are you sure?')">Usuń zgłoszenie</button>
            </form>
            </div>
        </div>


    </div>
    <!-- /BREADCRUMB -->
<div class="row layout-top-spacing">
    <div class="col-md-12">
        <div class="row layout-top-spacing">
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">
                <div class="widget-content widget-content-area br-8 p-5">
                    <h4>Aktualne dane zlecenia nr: {{$singleOrder->id}}</h4>
                    <h5 class="ms-5"  >Tytuł: {{$singleOrder->title}}</h5>
                    <div class="p-5 d-flex justify-content-evenly">
                        <div class="card w-50 p-5">
                        @foreach($users as $user)

                        @if($singleOrder->lead_person == $user->id)
                        <h6> <strong>Os. Odpowiedzialna:</strong> {{$user->name}}</h6>
                        <br>
                        @endif

                        @if($singleOrder->involved_person == $user->id)
                        <h6> <strong>Os. zaangażowana:</strong> {{ $user->name }}</h6>
                        <br>
                        @endif
                        
                        @endforeach

                        <h6> <strong>Os. kontaktowa:</strong> {{$contact->name}} {{$contact->surname}}</h6>
                        <br>


                        </div>
                        <div class="card w-50 p-5">
                        <h6><strong>Firma:</strong> {{$company->name}}</h6>
                        <br>
                        <h6><strong>Treść zgłoszenia:</strong> {{$singleOrder->order_content}}</h6>
                        <br>
                        <h6> <strong>Dodatkowe notatki wew:</strong> {{$singleOrder->order_notes}}</h6>
                        <br>
                        </div>
                        <div class="card w-50 p-5">
                        <h6><strong>Data otrzymania:</strong> {{$singleOrder->created_at}}</h6>
                        <br>
                        <h6><strong>Termin wykonania:</strong> {{$singleOrder->deadline}}</h6>
                        <h6> <strong>Status:</strong>  <span>{{$singleOrder->status}}</span></h6>
                        <br>
                        <h6><strong>Typ:</strong> rotacje</h6>
                        <br>
                        <h6> <strong>Reference to email:</strong> {{$singleOrder->email_id}}</h6>
                        <br>
                        </div>
                
                </div>
            </div>

        </div>

<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">

<div class="widget-content widget-content-area br-8">

    <div class="mt-container mx-auto">
        <div class="timeline-line">


            @foreach($orderNotifications as $notification)

            @switch($notification->type)

                @case('order_created')
                    <div class="item-timeline">
                        <p class="t-time">{{$notification->created_at}}</p>
                        <div class="t-dot t-dot-info">
                        </div>
                        <div class="t-text">
                            <p class="text-info">{{$notification->content}}</p>
                            {{-- <p>{{$notification->type}}</p> --}}
                            <p class="t-meta-time">{{$notification->updated_at->diffForHumans()}}<p>
                        </div>
                    </div>

                @break

                @case('email_received')
                    <div class="item-timeline">
                        <p class="t-time">{{$notification->created_at}}</p>
                        <div class="t-dot t-dot-danger">
                        </div>
                        <div class="t-text">
                            <p>{{$notification->content}}</p>
                            <p>Wiadomość od <a href="#">Piotr Wiski</a><a href="{{route('single.email',  $singleOrder->email_id)}}"> <button class="btn btn-danger">Pokaż</button></a></p></p>
                            {{-- <p>{{$notification->type}}</p> --}}
                            <p class="t-meta-time">{{$notification->updated_at->diffForHumans()}}<p>
                        </div>
                    </div>
                
                @break

                @case('order_update')
                    <div class="item-timeline">
                        <p class="t-time">{{$notification->created_at}}</p>
                        <div class="t-dot t-dot-success">
                        </div>
                        <div class="t-text">
                            <p class="text-danger">Zgłoszenie zostało edytowane i zaktualizowane!</p>
                            <p class=""> <strong>{{$notification->content}}</strong></p>
                            {{-- <p>{{$notification->content}}</p> --}}
                            {{-- <p>{{$notification->type}}</p> --}}
                            <p class="t-meta-time">{{$notification->updated_at->diffForHumans()}}<p>
                        </div>
                    </div>

                @break

                @case('order_status')
                    <div class="item-timeline">
                        <p class="t-time">{{$notification->created_at}}</p>
                        <div class="t-dot t-dot-success">
                        </div>
                        <div class="t-text">
                            <p class="text-light bg-info">Status zgłoszenia został zmieniony na:</p>
                            <p class="text-danger"> <strong>{{$notification->content}}</strong></p>
                            {{-- <p>{{$notification->content}}</p> --}}
                            {{-- <p>{{$notification->type}}</p> --}}
                            <p class="t-meta-time">{{$notification->updated_at->diffForHumans()}}<p>
                        </div>
                    </div>

                @break
                        
                
                @case('message_sent')

                    <div class="item-timeline">
                        <p class="t-time">{{$notification->created_at}}</p>
                        <div class="t-dot t-dot-warning">
                        </div>
                        <div class="t-text">
                            
                            <h6>Wysłana wiadomość: <span><button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#message-modal{{$notification->subjectId}}">Pokaż</button></span></h6>
                            
                            {{-- below content will have to go into small modal --}}
                            {{-- <p>{{$notification->content}}</p> --}}
                            {{-- <p>{{$notification->type}}</p> --}}
                            <p class="t-meta-time">{{$notification->updated_at->diffForHumans()}}<p>
                        </div>
                    </div>
{{-- Modal start --}}

                    <div class="modal fade" id="message-modal{{$notification->subjectId}}" tabindex="-1" aria-labelledby="message-modal-Label" aria-hidden="true">
                        @foreach($messagesToClient as $msg)
                        @if($notification->subjectId === $msg->id)
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tytuł: {{$msg->subject}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                <div class="mb-3">
                                    <h6>Do: {{$msg->to}} </h6>
                                </div>
                                <div class="mb-3">
                                    <p>Numer wiadomości: {{$msg->id}} </p>
                                </div>
                                <div class="mb-3">
                                    <p>{{$msg->content}}</p>
                                </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>

                    
{{-- modal end --}}
                @break

                @default
                    <div class="item-timeline">
                        <p class="t-time">{{$notification->created_at}}</p>
                        <div class="t-dot t-dot-success">
                        </div>
                        <div class="t-text">
                            <p>{{$notification->content}}</p>
                            <p>{{$notification->type}}</p>
                            <p class="t-meta-time">{{$notification->updated_at->diffForHumans()}}<p>
                        </div>
                    </div>

                @endswitch
                @endforeach
                    

        </div>                                    
    </div>

</div>   
</div>




@include('partials.order-comments')

    </div>
</div>

    
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>

        <script src="{{asset('plugins/global/vendors.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
        <script src="{{asset('plugins/glightbox/glightbox.min.js')}}"></script>
        <script src="{{asset('plugins/splide/splide.min.js')}}"></script>
        @vite(['resources/assets/js/apps/ecommerce-details.js'])

        <script src="{{asset('plugins/apex/apexcharts.min.js')}}"></script>
        {{-- <script src="{{asset('plugins/apex/custom-apexcharts.js')}}"></script> --}}
        @vite(['resources/assets/js/widgets/modules-widgets.js'])
        

        <script src="{{asset('plugins/global/vendors.min.js')}}"></script>
        <script src="{{asset('plugins/editors/quill/quill.js')}}"></script>
        <script src="{{asset('plugins/sweetalerts2/sweetalerts2.min.js')}}"></script>
        <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
        
        {{-- for order message --}}
        @vite(['resources/assets/js/apps/mailbox.js'])
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>