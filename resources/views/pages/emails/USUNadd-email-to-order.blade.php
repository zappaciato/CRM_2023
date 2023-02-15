<h1>Add email to order!</h1>

 <div class="widget-content widget-content-area"> 

                        <form class="row g-3 needs-validation" action="{{route('add.to.order', $email->id)}}" method="POST" novalidate>
                            @csrf                               

                            <input type="hidden" name="email_id" value="{{$email->id}}">
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">


                            <div class="col-md-4">
                                    <label for="order_id" class="form-label">Zgłoszenie</label>
                                        <select id="order_id" class="form-select " name="order_id">
                                            @foreach ($orders as $order )
                                                <option value="{{$order->id}}">{{$order->title}}</option>
                                            @endforeach
                                        </select>
                            </div>


                            
                            <div class="col-12">
                                <a href="#"><button class="btn btn-primary" type="submit">Dodaj</button></a>
                                {{-- <button class="btn btn-primary" type="submit">Dodaj</button> --}}
                            </div>

                        </form>


