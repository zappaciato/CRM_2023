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
                <li class="breadcrumb-item"><a href="#">Kontakt</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nowy kontakt</li>
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
    <a href="{{route('contact.list')}}"><button class="btn btn-success">Wróć do listy kontaktów</button></a>
</div>
    
    <div class="row d-flex justify-content-center layout-top-spacing">

            <div class="row col-10">
                <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Wypełnij dane nowego kontaktu</h4>
                                </div>                 
                            </div>
                        </div>

                        
                        <div class="widget-content widget-content-area"> 
                            <div class="col-md-12 mb-5">
                                <p>Jeśli nie znalazłeś firmy do nowego kontaktu, dodaj <strong> <u class="text-danger"> najpierw </u></strong> firmę.</p>
                                        <a href="{{route('company.add')}}"><button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-square"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></button></a>
                                </div>
                            <form class="row g-3 needs-validation" action="{{route('contact.add')}}" method="POST" novalidate>
        @csrf                               
                                {{-- <input id="role" type="hidden" value="nieprzypisany" class="form-control" name="role"> --}}

                                <div class="col-md-4">
                                <label for="name" class="form-label">Imię</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                </div>

                                

                                <div class="col-md-4">
                                <label for="surname" class="form-label">Nazwisko</label>
                                <input id="surname" type="text" class="form-control add-billing-address-input" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus required>
                                <div class="valid-feedback">
                                    Wyglada ok!
                                </div>
                                </div>

                                <div class="col-md-4">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <div class="valid-feedback">
                                    Wygląda ok!
                                </div>
                                </div>
{{-- dropdown list with companies --}}
                                

                                <div class="col-md-7 ">
                                <label for="company_id">Firma </label>
                                
                                        <select  id="company_id" name="company_id" class="form-select" >
                                            {{-- <option selected="" value="0">Bez firmy</option> --}}
                                @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                                        </select>
                                
                                </div>


                                {{-- <div class="col-md-4">
                                <label for="contact_person">Frima</label>                                 --}}
                                        {{-- <select  id="contact_person" name="contact_person" class="form-select" > --}}
                                            {{-- <option selected="">Jan Kowalski</option> --}}
                                {{-- @foreach($companies as $company) --}}
                                            {{-- <option value="{{$company->id}}">{{$company->name}}</option> --}}
                                {{-- @endforeach --}}
                                        {{-- </select>
                                </div> --}}


                                <div class="col-md-4">
                                <label for="position" class="form-label">Pozycja</label>
                                {{-- <input id="position" type="position" class="form-select" name="position" value="{{ old('position') }}" required autocomplete="position"> --}}
                                <select id="position" type="position" class="form-select" name="position" value="{{ old('position') }}">
                                <option value="owner">Właściciel</option>
                                <option value="management">Zarząd</option>
                                <option value="office-employee">Pracownik biura</option>
                                <option value="warehouse-employee">Pracownik magazynu</option>
                                <option value="factory-employee">Pracownik fabryki</option>
                                </select>
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


                                <div class="col-md-4">
                                <label for="phone" class="form-label">Telefon</label>
                                <input id="phone" type="phone" class="form-control" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                <div class="invalid-feedback">
                                    Podaj telefon
                                </div>
                                </div>

                                <div class="col-md-4">
                                <label for="phone_business" class="form-label">Telefon dodatkowy</label>
                                <input id="phone_business" type="text" class="form-control" name="phone_business" value="{{ old('phone_business') }}" required autocomplete="phone_business" autofocus>
                                <div class="invalid-feedback">
                                    Podaj telefon
                                </div>
                                </div>


                                <div class="col-md-12">
                                <label for="notes" class="form-label">Notatka</label>
                                <textarea id="notes" type="notes" class="form-control" name="notes" autocomplete="notes" cols="30" rows="7"></textarea>
                                </div>

                                {{-- quill --}}

{{-- <div id="basic" class="row layout-spacing layout-top-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4> Notatka </h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div id="editor-container">
                                <input id="notes" type="notes" class="form-control" name="notes" autocomplete="notes">
                    </div>


                </div>
            </div>
        </div>
    </div> --}}

                                {{-- end quill --}}

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




