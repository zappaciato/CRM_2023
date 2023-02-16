
                    <div class="modal fade" id="modaladd2order" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title add-title" id="notesMailModalTitleeLabel">Przypisz email do zgłoszenia</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <div class="compose-box">
                                        <div class="compose-content">
                                <form class="row g-3 needs-validation" action="{{route('add.to.order', $email->id)}}" method="POST" novalidate>
                                            @csrf
                                                <input type="hidden" name="email_id" value="{{$email->id}}">
                                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">    
                                            {{-- input ponizej bedzie mial wartosc po wybraniu zgłosenia / order i przypisany tam order_id --}}
                                                {{-- <input type="hidden" name="order_id" value="#"> --}}
                                                
                                                <div class="col-md-12">
                                    <label for="order_id" class="form-label">Wybierz zgłoszenie:</label>
                                        <select id="order_id" class="form-select " name="order_id">
                                            @foreach ($orders as $order )
                                                <option value="{{$order->id}}">{{$order->title}}</option>
                                            @endforeach
                                        </select>
                            </div>
                                                
                                                <div class="message-content">
                                                     <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> Notatka wewnętrzna:</p>
                                                     {{-- add nme for the form --}}
                                                    <textarea  class=""  id="message-content" name="notes" cols="58" rows="10">Notatka: Email Id: {{$email->id}}, tytuł: "{{$email->subject}}" </textarea>
                                                </div>

                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="#"><button class="btn btn-primary" type="submit">Dodaj</button></a>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>