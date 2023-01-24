















{{--  --}}

<h1>Single contact {{$contact->name}} ::: {{$contact->surname}}</h1>
@if($company[0]->name = '') 
   <h3>Ten kontakt nie ma przypisanej firmy.</h3> 
   <h4>Czy chcesz przypisac firmę do kontaktu?</h4>
@else
<h2>Ten kontakt należy do firmy {{$company[0]->name}}</h2>
@endif

<button><a href="{{route('contact.edit', $contact->id)}}">Edytuj kontakt</a></button>




 <form method="POST" action="{{route('contact.delete', $contact->id)}}">
            @csrf
            {{method_field('DELETE')}} 
            <button class="btn btn-danger mt-5" onclick="return confirm('Are you sure?')">Usuń kontakt</button>
        </form>

        

         