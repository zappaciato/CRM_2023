<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        @vite(['resources/scss/light/assets/components/timeline.scss'])

        @vite(['resources/scss/light/plugins/editors/quill/quill.snow.scss'])
        @vite(['resources/scss/dark/plugins/editors/quill/quill.snow.scss'])
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
                <li class="breadcrumb-item"><a href="#">Adres</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nowy Adres</li>
            </ol>
        </nav>
        
    </div>
    <!-- /BREADCRUMB -->

    <div class="d-flex flex-direction-row justify-content-end">
        <a href="{{route('company.list')}}"><button class="btn btn-success">Wróć do listy firm</button></a>
    </div>
    
    <div class="row d-flex justify-content-center layout-top-spacing">

        <div class="row col-10">
            <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Dodaj adres do firmy</h4>
                            </div>                 
                        </div>
                    </div>

                        
                    <div class="widget-content widget-content-area"> 
                        <div class="container d-flex col-md-8">
                        <form class="row g-3 needs-validation" action="{{route('address.add')}}" method="POST" novalidate>
                            @csrf                               

                            <div class="col-md-12">
                                    <label for="company_id" class="form-label">Firma</label>
                                        <select id="company_id" class="form-select company" name="company_id">
                                            {{-- <option selected="">FIrma Jeden</option> --}}
                                @foreach ($companies as $id => $company)
                                    <option value="{{$id}}">{{$company}}</option>
                                @endforeach
                                        </select>
                                </div>
                                
                                {{-- <input id="company_id" type="hidden" class="form-control" name="company_id" value="" required autocomplete="company_id"> --}}

                                <div class="col-md-12">
                                    <label for="name" class="form-label">Nazwa Adresu</label>
                                    <input type="text" id="name" class="form-control" name="name" value="Adres firmy : " required autocomplete="name" autofocus required>
                                </div>

                                <div class="col-md-4">
                                    <label for="street" class="form-label">Ulica</label>
                                    <input id="street" type="text" class="form-control add-billing-address-input" name="street" value="{{ old('street') }}" required autocomplete="street" autofocus required>
                                </div>

                                <div class="col-md-4">
                                    <label for="city" class="form-label">Miasto</label>
                                    <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" required autocomplete="city">
                                </div>

                                <div class="col-md-4">
                                    <label for="postal_code" class="form-label">Kod pocztowy</label>
                                    <input id="postal_code" type="text" class="form-control" name="postal_code" value="{{ old('postal_code') }}" required autocomplete="postal_code">
                                </div>

                                <div class="col-md-6">
                                    <label for="province" class="form-label">Województwo</label>
                                    <input id="province" type="text" class="form-control" name="province" value="{{ old('province')}}" required autocomplete="province">
                                </div>

                                <div class="col-md-6">
                                    <label for="country" class="form-label">Kraj</label>
                                    <input id="country" type="text" class="form-control" name="country" value="" required autocomplete="country">
                                </div>

                                <div class="col-md-12">
                                    <label for="notes" class="form-label">Notatka</label>
                                    <textarea id="notes" type="notes" class="form-control" name="notes" autocomplete="notes" cols="30" rows="7"></textarea>
                                </div>

                                <div class="col-12">
                                <a href="{{route('address.add')}}"><button class="btn btn-primary" type="submit">Dodaj dodatkowy adres do firmy</button></a>
                                {{-- <button class="btn btn-primary" type="submit">Dodaj</button> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                                
{{-- dropdown na potem w razie czego --}}
                                {{-- <div class="col-md-3">
                                <label for="validationCustom04" class="form-label">State</label>
                                <select class="form-select" id="validationCustom04" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option>...</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid state.
                                </div>
                                </div> --}}



    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script type="module" src="{{asset('plugins/editors/quill/quill.js')}}"></script>
        <script type="module" src="{{asset('plugins/editors/quill/custom-quill.js')}}"></script>

<script>

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

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">
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
</script>


    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>




