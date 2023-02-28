<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        @vite(['resources/scss/light/assets/components/timeline.scss'])

        {{-- @vite(['resources/scss/light/plugins/editors/quill/quill.snow.scss'])
        @vite(['resources/scss/dark/plugins/editors/quill/quill.snow.scss']) --}}
        <!--  END CUSTOM STYLE FILE  -->
        
        <style>
            .toggle-code-snippet { margin-bottom: 0px; }
            body.dark .toggle-code-snippet { margin-bottom: 0px; }
        </style>
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    {{-- <x-slot:scrollspyConfig>
        data-bs-spy="scroll" data-bs-target="#navSection" data-bs-offset="100"
    </x-slot> --}}
    
    <!-- BREADCRUMB -->
    <div class="page-meta d-flex justify-content-between">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Zgłoszenie</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nowe zgłoszenie</li>
            </ol>
        </nav>
        
        
    </div>
    <!-- /BREADCRUMB -->

    {{-- <div id="navSection" data-bs-spy="affix" class="nav  sidenav">
        <div class="sidenav-content">
            <a href="#basic" class="active nav-link">Basic</a>
            <a href="#custom_styles" class="nav-link">Custom Styles</a>
            <a href="#browser_default" class="nav-link">Browser Default</a>
            <a href="#tooltips" class="nav-link">Tooltips</a>
        </div>
    </div> --}}

    <div class="d-flex flex-direction-row justify-content-end">
    <a href="{{route('service.orders')}}"><button class="btn btn-success">Wróć do listy zgłoszeń</button></a>
</div>
    
    <div class="row d-flex justify-content-center layout-top-spacing">

            <div class="row col-10">
                <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Aktualizuj dane istniejącego zgłoszenia</h4>
                                </div>                 
                            </div>
                        </div>

                        
                        <div class="widget-content widget-content-area"> 
                            <form method="POST" action="{{ route('single.service.order.edit', $singleOrder->id) }}" enctype="multipart/form-data">
        @csrf                               
                                {{-- <input id="role" type="hidden" value="nieprzypisany" class="form-control" name="role"> --}}
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="email_id" value="{{$singleOrder->email_id}}">
                                <div class="col-md-12">
                                <h6>Firma:</h6>
                                        <h4 class="text-danger">{{$company->name}}</h4>
                                            {{-- <option selected="">FIrma Jeden</option> --}}
                                    <input type="hidden" name="company_id" value="{{$company->id}}">
                                </div>
                                <hr>
                                <div class="col-md-12 mt-2">
                                    <label for="title" class="form-label">Tytuł zgłoszenia</label>
                                        <input type="text" name="title" class="form-control" id="title" value="{{$singleOrder->title}}">
                                        </select>

                                </div>

                                <div class="col-md-4">
                                <label for="address">Adres:</label>
                                        <select  id="address" name="address" class="form-select" >
                                            @foreach ($addresses as $address)
                                                <option selected>{{$address->name}}</option>
                                            @endforeach

                                        </select>
                                </div>

                                {{-- contacts dependable list --}}
                                <div class="col-md-4 form-group {{ $errors->has('comapny_id') ? 'has-error' : '' }}"> 
                                    <label for="contact_person">Osoba kontaktowa z firmy</label>
                                    <select name="contact_person" id="contact_person" class="form-select" >
                                        
                                        @foreach ($contacts as $contact )
                                            <option value="{{$contact->id}}" {{$contact->id == $singleOrder->contact_person ? "selected" : ""}}>{{$contact->name}}
                                        @endforeach
                                    </select>
                                    
                                    
                                @if($errors->has('contact_person'))
                                    <p class="help-block">
                                        {{ $errors->first('contact_person') }}
                                    </p>
                                @endif
                                </div>
                                


                                <div class="col-md-3">
                                <label for="lead_person">Os. odpowiedzialna</label>
                                
                                        <select  id="lead_person" name="lead_person" class="form-select" >
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}" {{$user->id == $singleOrder->lead_person ? "selected" : ""}}>{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                </div>

                                <div class="col-md-3">
                                <label for="involved_person">Os. zaangażowana</label>
                                        <select  id="involved_person" name="involved_person" class="form-select" >
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}" {{$user->id == $singleOrder->involved_person ? "selected" : ""}}>{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                </div>

                                <div class="col-md-2">
                                <label for="priority" class="form-label">Priorytet</label>
                                        <select  id="priority" name="priority" class="form-select" >
                                            <option selected="">{{$singleOrder->priority}}</option>
                                            <option>Wysoki</option>
                                            <option>Średni</option>
                                            <option>Niski</option>
                                        </select>
                                </div>

                                <div class="col-md-2">
                                <label for="status" class="form-label">Status</label>
                                        <select  id="status" name="status" class="form-select" >
                                            <option selected="">{{$singleOrder->status}}</option>
                                            <option>Nowe</option>
                                            <option>Otwarte</option>
                                            <option>W toku</option>
                                            <option>Reklamacje</option>
                                            <option>Sfinalizowane</option>
                                            <option>Anulowane</option>
                                        </select>
                                </div>

                                <div class="col-md-2">
                                <label for="deadline">Termin wykonania</label>
                                        <input type="date" class="form-control" id="deadline" name="deadline" value="{{$singleOrder->deadline}}"> 
                                </div>

                                <div class="col-md-8">
                                <label for="order_content">Zawartość zgłoszenia</label>
                                        <textarea type="text" class="form-control" id="order_content" name="order_content">{{$singleOrder->order_content}} </textarea>
                                </div>

                                <div class="col-md-4">
                                <label for="order_notes">Uwagi do zgłoszenia</label>
                                        <textarea type="text" class="form-control" id="order_notes" name="order_notes" name="order_notes">{{$singleOrder->order_notes}} </textarea>
                                </div>

                                <div class="col-12">
                                <button class="btn btn-primary" type="submit">Dodaj</button>
                                </div>
                            </form>


                                </div>
                            </div>

                        </div>
                    </div>
        </div>


    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        {{-- <script type="module" src="{{asset('plugins/editors/quill/quill.js')}}"></script>
        <script type="module" src="{{asset('plugins/editors/quill/custom-quill.js')}}"></script> --}}
{{-- <script>
    window.addEventListener('load', function() {
// Fetch all the forms we want to apply custom Bootstrap validation styles to
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form) {
form.addEventListener('submit', function(event) {
if (form.checkValidity() === false) {
event.preventDefault();
event.stopPropagation();
}
form.classList.add('was-validated');
}, false);
});
}, false);
</script>

<script>
    var quill = new Quill('#editor-container', {
modules: {
toolbar: [
[{ header: [1, 2, false] }],
['bold', 'italic', 'underline'],
['image', 'code-block']
]
},
placeholder: 'Dodaj notatkę...',
theme: 'snow'  // or 'bubble'
});
</script> --}}


{{-- jQuery and AJAX for for the dropdown list --}}

{{-- trzeba to potem do pliku wrzucic i reference: <script src="{{ asset('assets/cosctammm/js/jquery.min.js') }}"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

{{-- <script type="text/javascript">

$(document).ready(function(){
        $(document).on('change', '.company', function() {
        console.log('It has changed!');

        var company_id = $(this).find(':selected').val();
        console.log(company_id);

if(company_id) {
        $.ajax({
            type: 'GET',
            // url: "{!! URL::to('orders-add/fetch-contacts') !!}",
            // url: "{{ url('/orders-add/fetch-contacts') }}/" + company_id,
            url: "{{ route('fetch.contacts') }}?country_id=" + $(this).val(),
            // dataType: 'json',
            // data: {'id':company_id},
            success: function(data){
                console.log('Success with AJAX');
                console.log(data);
            },
            error: function(data){
                console.log('Didnt work out!');
            }
        })

    } else {
                    alert('danger');
                }

    });
});

</script> --}}

{{-- <script type="text/javascript">
$(document).ready(function(){
    $('#company_id').change(function() {
        $.ajax({
            url: "{{ route('fetch.contacts') }}?company_id=" + $(this).val(),
            methods: 'GET',
            success: function(data) {
                console.log(data);
                console.log('It is working you bloody AJAX fetching contacts on company change');
                $('#contact_person').html(data.html);
            }
        });

        $.ajax({
            url: "{{ route('fetch.addresses') }}?company_id=" + $(this).val(),
            methods: 'GET',
            success: function(data) {
                console.log(data);
                console.log('It is working you bloody AJAX');
                $('#address').html(data.html);
            }
        });


    });

    $.ajax({
            url: "{{ route('fetch.users') }}",
            methods: 'GET',
            success: function(data) {
                console.log(data);
                console.log('It is working you bloody AJAX');
                $('#lead_person').html(data.html);
            }
        });

    $.ajax({
            url: "{{ route('fetch.users') }}",
            methods: 'GET',
            success: function(data) {
                console.log(data);
                console.log('It is working you bloody AJAX');
                $('#involved_person').html(data.html);
            }
        });

})
</script> --}}

    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>




