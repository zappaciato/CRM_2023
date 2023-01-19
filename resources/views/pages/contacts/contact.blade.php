















{{--  --}}

<h1>Single contact {{$contact->name}} ::: {{$contact->surname}}</h1>


<button><a href="{{route('contact.edit', $contact->id)}}">Edytuj kontakt</a></button>




 <form method="POST" action="{{route('contact.delete', $contact->id)}}">
            @csrf
            {{method_field('DELETE')}} 
            <button class="btn btn-danger mt-5" onclick="return confirm('Are you sure?')">Usuń kontakt</button>
        </form>

        

         