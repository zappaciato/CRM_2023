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
                                    <h4>Podaj adres nowej firmy</h4>
                                </div>                 
                            </div>
                        </div>

                        <div class="container">
                            <h4>Dane firmy:</h4>
                            <h6>Nazwa firmy: <span>{{$company->name}}</span></h6>
                            <h6>Nip firmy:  <span>{{$company->nip}}</h6>
                            <h6>Telefon:  <span>{{$company->phone}}</h6>
                            <h6>Email:  <span>{{$company->email}}</h6>
                            <h6>Strona www:  <span>{{$company->www}}</h6>
                            
                        </div>

                        
                        <div class="widget-content widget-content-area"> 
                            <div class="container d-flex col-md-8">
                            <form class="row g-3 needs-validation" action="{{route('address.add')}}" method="POST" novalidate>
        @csrf                               

                            <input id="company_id" type="hidden" class="form-control" name="company_id" value="{{ $company->id }}" required autocomplete="company_id">

                                <div class="col-md-12">
                                <label for="name" class="form-label">Nazwa Adresu</label>
                                <input type="text" id="name" class="form-control" name="name" value="Adres firmy : {{ $company->name }}" required autocomplete="name" autofocus required>
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
                                <input id="country" type="text" class="form-control" name="country" value="{{$company->country}}" required autocomplete="country">

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

                                

                                <div class="col-md-12">
                                <label for="notes" class="form-label">Notatka</label>
                                <textarea id="notes" type="notes" class="form-control" name="notes" autocomplete="notes" cols="30" rows="7"></textarea>
                                </div>

                                <div class="col-12">
                                <a href="{{route('address.add')}}"><button class="btn btn-primary" type="submit">Dodaj</button></a>
                                {{-- <button class="btn btn-primary" type="submit">Dodaj</button> --}}
                                </div>
                            </form>


                                </div>
                                </div>
                            </div>

                        </div>
                    </div>
        </div>


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
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>




