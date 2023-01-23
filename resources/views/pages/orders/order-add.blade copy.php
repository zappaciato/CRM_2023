<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{asset('plugins/stepper/bsStepper.min.css')}}">
        @vite(['resources/scss/light/plugins/stepper/custom-bsStepper.scss'])
        @vite(['resources/scss/dark/plugins/stepper/custom-bsStepper.scss'])
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    {{-- <x-slot:scrollspyConfig>
        data-bs-spy="scroll" data-bs-target="#navSection" data-bs-offset="100"
    </x-slot> --}}
    
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dodaj zgłoszenie</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nowe zgłoszenie</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->


    <div class="row layout-top-spacing" id="cancel-row">

        <div id="wizard_Default" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Zgłoszenie</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="bs-stepper stepper-form-one">
                        <div class="bs-stepper-header" role="tablist">
                            <div class="step" data-target="#defaultStep-one">
                                <button type="button" class="step-trigger" role="tab" >
                                    <span class="bs-stepper-circle">1</span>
                                    {{-- <span class="bs-stepper-label">Step One</span> --}}
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#defaultStep-two">
                                <button type="button" class="step-trigger" role="tab"  >
                                    <span class="bs-stepper-circle">2</span>
                                    {{-- <span class="bs-stepper-label">Step Two</span> --}}
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#defaultStep-three">
                                <button type="button" class="step-trigger" role="tab"  >
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label">
                                        {{-- <span class="bs-stepper-title">Step Three</span> --}}
                                    </span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#defaultStep-four">
                                <button type="button" class="step-trigger" role="tab"  >
                                    <span class="bs-stepper-circle">4</span>
                                    <span class="bs-stepper-label">
                                        {{-- <span class="bs-stepper-title">Step Three</span> --}}
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <form action="{{route('add.order')}}" method="GET">
                            <div id="defaultStep-one" class="content" role="tabpanel">
                                <div class="col-md-12 d-flex justify-content-center flex-column">
                                    {{-- <div class="form-group mb-4">
                                        <label for="company">Firma</label>
                                        <input type="text" class="form-control" id="company" name="company">
                                    </div> --}}
                                <div class="form_section_wrap d-flex">
                                    <div class="col-md-5 me-5">
                                        <label for="company" class="form-label">Firma</label>
                                        <select id="company" class="form-select" name="company">
                                            <option selected="">FIrma Jeden</option>
                                            <option>Firma dwa</option>
                                            <option>Firma trzy</option>
                                        </select>
                                        
                                    </div>

                                    <div class="col-md-5">
                                        <label for="contact_person">Osoba kontaktowa z firmy</label>
                                        <select  id="contact_person" name="contact_person" class="form-select" >
                                            <option selected="">Jan Kowalski</option>
                                            <option>Cezary Pazura</option>
                                            <option>Michaell Jordan</option>
                                        </select>
                                        
                                    </div>

                                    </div>
                                    {{-- rozwijana lista oraz możliwość kliknięcia potem w osobę kontaktową gdzie potem przejdziemy do ich danych np tel; tooltip z telefonem i emailem?? --}}
                                    {{-- <div class="form-group mb-4 col-4">
                                        <label for="contact_person">Osoba kontaktowa z firmy</label>
                                        <input type="text" class="form-control" id="contact_person" name="contact_person">
                                    </div> --}}
                                    {{-- input tylko z adresami danej firmy. jesli jeden to tylko on do wyboru --}}
                                    <div class="form-group mb-4">
                                        <label for="address">Adres firmy</label>
                                        <input type="text" class="form-control" id="address" name="address">
                                    </div>
                                </div>
                                
                                <div class="button-action mt-5">
                                    <button class="btn btn-secondary btn-prev me-3" disabled>Prev</button>
                                    <button class="btn btn-secondary btn-nxt">Next</button>
                                </div>
                            </div>
                            <div id="defaultStep-two" class="content" role="tabpanel">
                                <div>
                                    <div class="form-group mb-4">
                                        <label for="manager">Prowadzący</label>
                                        <input type="text" class="form-control" id="manager" name="manager">
                                    </div>
                                    {{-- tutaj musi byc multiple choice option --}}
                                    <div class="form-group mb-4">
                                        <label for="involved_person">Osoby zaangażowane</label>
                                        <input type="email" class="form-control" id="involved_person" name="involved_person">
                                    </div>
                                    
                                </div>
                                
                                <div class="button-action mt-5">
                                    <button class="btn btn-secondary btn-prev me-3">Prev</button>
                                    <button class="btn btn-secondary btn-nxt">Next</button>
                                </div>
                            </div>
                            <div id="defaultStep-three" class="content" role="tabpanel">
                                <div>
                                    <div class="form-group mb-4">
                                        <label for="order_content">Zawartość zgłoszenia</label>
                                        <textarea type="text" class="form-control" id="order_content" name="order_content"> </textarea>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="order_notes">Uwagi do zgłoszenia</label>
                                        <textarea type="text" class="form-control" id="order_notes" name="order_notes" name="order_notes"> </textarea>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="order_notes">Załącz dokumenty</label>
                                        <textarea type="text" class="form-control" id="order_notes" name="order_notes" name="order_notes"> </textarea>
                                    </div>
                                </div>
                                
                                <div class="button-action mt-5">
                                    <button class="btn btn-secondary btn-prev me-3">Prev</button>
                                    <button class="btn btn-secondary btn-nxt">Next</button>
                                </div>
                            </div>
                            <div id="defaultStep-four" class="content" role="tabpanel" >
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="priority" class="form-label">Priorytet</label>
                                        <input type="text" class="form-control" id="priority" name="priority">
                                    </div>
                                    <div class="col-12">
                                        <label for="deadline" class="form-label">Planowana data zakończenia</label>
                                        <input type="text" class="form-control" id="deadline" name="deadline">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status" class="form-label">Status</label>
                                        <input type="text" class="form-control" id="stauts" name="status">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="defaultInputState" class="form-label">State</label>
                                        <select id="defaultInputState" class="form-select">
                                            <option selected="">Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="defaultInputZip" class="form-label">Zip</label>
                                        <input type="text" class="form-control" id="defaultInputZip">
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="defaultGridCheck">
                                            <label class="form-check-label" for="defaultGridCheck">
                                                Check me out
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="button-action mt-3">
                                    <button class="btn btn-secondary btn-prev me-3">Prev</button>
                                    <button type="submit" class="btn btn-success me-3">Submit</button>
                                </div>
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
        <script src="{{asset('plugins/stepper/bsStepper.min.js')}}"></script>
        <script src="{{asset('plugins/stepper/custom-bsStepper.min.js')}}"></script>
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>