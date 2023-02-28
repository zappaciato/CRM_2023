
<div class="d-flex">

                <a href="{{route('service.orders')}}"><button class="btn btn-success btn-lg">Wróć</button></a>
                <a href="{{route('single.service.order.edit', $singleOrder->id)}}"><button class="btn btn-warning ms-5 btn-lg">Edytuj</button></a>
                <button type="button" class="btn btn-info btn-lg cancel-btn ms-5" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Wyślij wiadomość do klienta</button>
                <a href="{{route('display.assigned.emails', $singleOrder->id)}}"><button type="button" class="btn btn-showemails btn-lg  ms-2" >Powiązane Emaile</button></a>
                <a href="{{route('display.assigned.files', $singleOrder->id)}}"><button type="button" class="btn btn-showfiles btn-lg  ms-2" >Powiązane pliki</button></a>
                
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
