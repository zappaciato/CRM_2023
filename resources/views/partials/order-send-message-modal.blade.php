
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
                                            <form class="row g-3 needs-validation" action="{{route('message.to.client', $singleOrder->id)}}" method="POST" novalidate enctype="multipart/form-data">
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
                                                                <input type="email" id="m-to" name="to" class="form-control" value="{{$contactPerson->email}}">
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
                                                    <input class="form-control file-upload-input" name="msg-attachment" type="file" id="formFile" multiple="multiple">
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