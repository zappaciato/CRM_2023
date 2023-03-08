<div id="iconsAccordion" class="accordion-icons accordion">
    <div class="card">
        <div class="card-header" id="...">
            <section class="mb-0 mt-0 d-flex justify-content-center bg-info">
                <div role="menu" class="collapsed" data-bs-toggle="collapse" data-bs-target="#iconAccordionOne" aria-expanded="true" aria-controls="iconAccordionOne">
                    <div class="accordion-icon"><svg> ... </svg></div>
                    <h4 class="text-white">Timeline zdarzeń zgłoszenia [{{count($orderNotifications)}}]  </h4>
                    <div class="icons"><svg> ... </svg></div>
                </div>
            </section>
        </div>

        <div id="iconAccordionOne" class="collapse" aria-labelledby="..." data-bs-parent="#iconsAccordion">
            <div class="card-body">
                
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

                                        @foreach($emailsAssigned as $email)
                                            @if($email->id === $notification->subjectId)
                                                <p>[" {{$email->subject}} "]</p>

                                                {{-- tutaj powinna sie znaleźć funkcjonalnosc pozwalająca na kliknięcie na kontakt i przekierowanie do profilu. Za dużo zanieżdzen i nie wiem jak to obejść. Funkcjonalnosc nie jest krytyczna. Czasowo przekierowuje do listy kontaktów co częściowo rozwiązuje problem.  --}}
                                                {{-- @foreach($contacts as $contact) --}}
                                                    {{-- @if($contact->email === $email->from_address) --}}
                                                        <p>Email od <a href="{{route('contact.list')}}">{{ $email->from_name }}</a><a href="{{route('single.email',  $email->id)}}"> <button class="btn btn-danger">Pokaż</button></a></p></p>
                                                        {{-- @else
                                                        <p>Email od <a href="{{ route('single.contact', $contact->id)}}">Nie ma w bazie</a><a href="{{route('single.email',  $email->id)}}"> <button class="btn btn-danger">Pokaż</button></a></p></p> --}}
                                                    {{-- @endif --}}
                                                {{-- @endforeach --}}
                                            @endif
                                        @endforeach

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
                                        <p class="text-danger">Zgłoszenie zostało edytowane i zaktualizowane! </p>
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

                                            <div class="mb-3">
                                                <h6>Do: {{$msg->to}} </h6>
                                            </div>
                                            <div class="mb-3">
                                                <p>Numer wiadomości: {{$msg->id}} </p>
                                            </div>
                                            <hr>

                                            <div class="mb-3">
                                                <p>{{$msg->content}}</p>
                                            </div>
                                            <hr>
                                            <div class="mb-3">
                                                @foreach ($attachmentsLinks as $key => $link)
                                                
                                                    @if($key === $msg->id)
                                                <p>ZAŁĄCZNIKI:</p>
                                                @php
                                                        echo $key;
                                                        echo $msg->id;
                                                @endphp
                                                <p><a href="{{$link[0]}}" target="_blank">{{$link[1]}} </a></p>
                                                
                                                    


                                                    @endif
                                                @endforeach
                                            </div>
                                            <hr>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
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
  </div>

    {{-- <div class="card">
        <div class="card-header" id="...">
            <section class="mb-0 mt-0">
                <div role="menu" class="collapsed" data-bs-toggle="collapse" data-bs-target="#iconAccordionTwo" aria-expanded="false" aria-controls="iconAccordionTwo">
                    <div class="accordion-icon"><svg> ... </svg></div>
                    Collapsible Group Item #2  <div class="icons"><svg> ... </svg></div>
                </div>
            </section>
        </div>
        <div id="iconAccordionTwo" class="collapse" aria-labelledby="..." data-bs-parent="#iconsAccordion">
            <div class="card-body">

                ...................
                ...................

            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="...">
            <section class="mb-0 mt-0">
                <div role="menu" class="" data-bs-toggle="collapse" data-bs-target="#iconAccordionThree" aria-expanded="false" aria-controls="iconAccordionThree">
                    <div class="accordion-icon"><svg> ... </svg></div>
                    Collapsible Group Item #3 <div class="icons"><svg> ... </svg></div>
                </div>
            </section>
        </div>
        <div id="iconAccordionThree" class="collapse show" aria-labelledby="..." data-bs-parent="#iconsAccordion">
        <div class="card-body">
            
            ..................
            ..................

        </div>
        </div>
    </div> --}}
</div>


