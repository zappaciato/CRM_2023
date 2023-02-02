<h1>Edycja zgłoszenia {{$singleOrder->id}}{{$singleOrder->title}}</h1>
<form method="POST" action="{{ route('single.service.order.edit', $singleOrder->id) }}" enctype="multipart/form-data">
            @csrf
    <input type="hidden" name="_method" value="PUT">
<input type="text" name="status">
<button type="submit">Zmien status</button>
</form>