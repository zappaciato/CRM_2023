<h1>These are the emails</h1>
@foreach($emails as $email)
<p>{{$email->subject}}</p>
@endforeach