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
    <a href="{{route('service.orders')}}"><button class="btn btn-success">Wróć do listy zgłoszeń</button></a>
</div>
    
    <div class="row d-flex justify-content-center layout-top-spacing">

            <div class="row col-10">
                <div id="custom_styles" class="col-lg-12 layout-spacing col-md-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Wypełnij dane nowego zgłoszenia</h4>
                                </div>                 
                            </div>
                        </div>

                        
                        <div class="widget-content widget-content-area"> 
                            <form class="row g-3 needs-validation" action="{{route('add.order')}}" method="POST" novalidate>
        @csrf                               
                                {{-- <input id="role" type="hidden" value="nieprzypisany" class="form-control" name="role"> --}}

                                <div class="col-md-4">
                                    <label for="company" class="form-label">Firma</label>
                                        <select id="company" class="form-select" name="company" value>
                                            <option selected="">FIrma Jeden</option>
                                            <option>Firma dwa</option>
                                            <option>Firma trzy</option>
                                        </select>

                                </div>

                                

                                <div class="col-md-4">
                                <label for="contact_person">Osoba kontaktowa z firmy</label>
                                        <select  id="contact_person" name="contact_person" class="form-select" >
                                            <option selected="">Jan Kowalski</option>
                                            <option>Cezary Pazura</option>
                                            <option>Michaell Jordan</option>
                                        </select>
                                </div>

                                <div class="col-md-4">
                                <label for="contact_person">Adres</label>
                                        <select  id="address" name="address" class="form-select" >
                                            <option selected="">Pl WOlności</option>
                                            <option>Oxford St</option>
                                            <option>Umberstabmbplatz</option>
                                        </select>
                                </div>

                                <div class="col-md-4">
                                <label for="manager">Prowadzący</label>
                                        <select  id="manager" name="manager" class="form-select" >
                                            <option selected="">Wojtek</option>
                                            <option>Jacek St</option>
                                            <option>Ula brzozowicz</option>
                                        </select>
                                </div>

                                <div class="col-md-4">
                                <label for="involved_person">Prowadzący</label>
                                        <select  id="involved_person" name="involved_person" class="form-select" >
                                            <option selected="">Marcin</option>
                                            <option>Jadwiga</option>
                                            <option>Umbro</option>
                                        </select>
                                </div>

                                <div class="col-md-4">
                                <label for="priority" class="form-label">Priorytet</label>
                                        <select  id="priority" name="priority" class="form-select" >
                                            <option selected="">Wysoki</option>
                                            <option>Średni</option>
                                            <option>Niski</option>
                                        </select>
                                </div>


                                <div class="col-md-8">
                                <label for="order_content">Zawartość zgłoszenia</label>
                                        <textarea type="text" class="form-control" id="order_content" name="order_content"> </textarea>
                                </div>

                                <div class="col-md-4">
                                <label for="order_notes">Uwagi do zgłoszenia</label>
                                        <textarea type="text" class="form-control" id="order_notes" name="order_notes" name="order_notes"> </textarea>
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




