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
                                        @if($email->id == $notification->subjectId)
                                        <p>{{$email->subject}}</p>
                                        <p>Wiadomość od <a href="{{$contact->email === $email->from_address ? route('single.contact', $contact->id) : "Email z kontaktu poza bazą danych!"}}">{{$contact->email === $email->from_address ? $email->from_name : "Kontakt poza bazą danych!"}}</a><a href="{{route('single.email',  $email->id)}}"> <button class="btn btn-danger">Pokaż</button></a></p></p>
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

                                            <div class="mb-3">
                                                <h6>Do: {{$msg->to}} </h6>
                                            </div>
                                            <div class="mb-3">
                                                <p>Numer wiadomości: {{$msg->id}} </p>
                                            </div>
                                            <div class="mb-3">
                                                <p>{{$msg->content}}</p>
                                            </div>

                                            <div class="mb-3">
                                                @foreach ($attachmentsLinks as $link)
                                                <p><a href="{{$link}}" target="_blank">{{$link}}</a></p>
                                                @endforeach
                                            </div>

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