<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        {{-- @vite(['resources/scss/light/assets/components/timeline.scss']) --}}
        <link rel="stylesheet" href="{{asset('plugins/filepond/filepond.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/filepond/FilePondPluginImagePreview.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/sweetalerts2/sweetalerts2.css')}}">

        @vite(['resources/scss/light/plugins/filepond/custom-filepond.scss'])
        @vite(['resources/scss/light/assets/components/tabs.scss'])
        @vite(['resources/scss/light/assets/elements/alert.scss'])        
        @vite(['resources/scss/light/plugins/sweetalerts2/custom-sweetalert.scss'])
        @vite(['resources/scss/light/plugins/notification/snackbar/custom-snackbar.scss'])
        @vite(['resources/scss/light/assets/forms/switches.scss'])
        @vite(['resources/scss/light/assets/components/list-group.scss'])
        @vite(['resources/scss/light/assets/users/account-setting.scss'])

        @vite(['resources/scss/dark/plugins/filepond/custom-filepond.scss'])
        @vite(['resources/scss/dark/assets/components/tabs.scss'])
        @vite(['resources/scss/dark/assets/elements/alert.scss'])        
        @vite(['resources/scss/dark/plugins/sweetalerts2/custom-sweetalert.scss'])
        @vite(['resources/scss/dark/plugins/notification/snackbar/custom-snackbar.scss'])
        @vite(['resources/scss/dark/assets/forms/switches.scss'])
        @vite(['resources/scss/dark/assets/components/list-group.scss'])
        @vite(['resources/scss/dark/assets/users/account-setting.scss'])

        
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Kontakt</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dane i ustawienia</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
        
    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="row mb-3">
                <div class="col-md-12">
                    <h2>Dane kontaktu: {{$singleContact->name .' '. $singleContact->surname}} </h2>

                    <ul class="nav nav-pills" id="animateLine" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="animated-underline-home-tab" data-bs-toggle="tab" href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Dane osobowe</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-company-tab" data-bs-toggle="tab" href="#animated-underline-company" role="tab" aria-controls="animated-underline-company" aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg> Firma</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-orders-tab" data-bs-toggle="tab" href="#animated-underline-orders" role="tab" aria-controls="animated-underline-orders" aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Lista zgłoszeń tego kontaktu</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-notes-tab" data-bs-toggle="tab" href="#animated-underline-notes" role="tab" aria-controls="animated-underline-notes" aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> Inne</button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tab-content" id="animateLineContent-4">

               {{-- info about the contact --}}
                <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel" aria-labelledby="animated-underline-home-tab">
                    <div class="row card p-5">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                <div class="info">
                                    <h6 class="">Informacje ogólne kontaktu</h6>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                

                                                <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <h5>Imię: {{$singleContact->name}}</h5>
                                                                    <h5>Nazwisko: {{$singleContact->surname}}</h5>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <h5>Pozycja: {{$singleContact->position}}</h5>
                                                                </div>
                                                            </div>                                                          
                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <h5>Email: {{$singleContact->email}}</h5>
                                                                </div>
                                                            </div> 
                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <h5>Telefon: {{$singleContact->phone}}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <h5>Telefon 2: {{$singleContact->phone_business}}</h5>
                                                                </div>
                                                            </div>
                                                            {{--Ntatka: to moze pojawic sie np w modalu --}}
                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <h5>Notatka: {{$singleContact->notes}}</h5>
                                                                </div>
                                                            </div>

                                                            {{-- <div class="col-md-12 mt-1">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="customCheck1">
                                                                    <label class="form-check-label" for="customCheck1">Make this my default address</label>
                                                                </div>
                                                            </div> --}}

                                                            <div class="col-md-12 mt-1">
                                                                <div class="form-group text-end">
                                                                  <a href="{{route('contact.edit', $singleContact->id)}}"><button  class="btn btn-secondary">Edytuj kontakt</button></a>
                                                                    
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>

                    </div>
                </div>
{{-- info about the company and address--}}
                <div class="tab-pane fade show" id="animated-underline-company" role="tabpanel" aria-labelledby="animated-underline-company-tab">
                    <div class="row card p-5">
                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                <div class="info">
                                    <h6 class="">Informacje o firmie</h6>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                
                                                <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <h5>Nazwa firmy: {{$company->name}}</h5>
                                                                
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <h5>NIP: {{$company->nip}}</h5>
                                                                </div>
                                                            </div>                                                          
                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <h5>Główny adres Email: {{$company->email}}</h5>
                                                                </div>
                                                            </div> 
                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <h5>Telefon: {{$company->phone}}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <h5>Telefon stacjonarny: {{$company->phone_stationary}}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <h5>Kraj: {{$company->country}}</h5>
                                                                </div>
                                                            </div>
                                                            {{--Ntatka: to moze pojawic sie np w modalu --}}
                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <h5>Notatka: {{$singleContact->notes}}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="info me-5">
<h6 class="me-5">Adres</h6>
</div>
                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <h5>Ulica: {{$companyAddress->street}}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <h5>Miasto: {{$companyAddress->city}}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <h5>Kraj: {{$companyAddress->country}}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="">
                                                                    <h5>Notatka: {{$companyAddress->notes}}</h5>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="col-md-12 mt-1">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="customCheck1">
                                                                    <label class="form-check-label" for="customCheck1">Make this my default address</label>
                                                                </div>
                                                            </div> --}}

                                                            <div class="col-md-12 mt-1">
                                                                <div class="text-end">
                                                                  <a href="{{route('company.edit', $company->id)}}"><button  class="btn btn-secondary">Edytuj firmę</button></a>
                                                                    
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>
                        

                        
                        
                    </div>
                </div>
{{-- info about orders for this contact --}}
                <div class="tab-pane fade show" id="animated-underline-orders" role="tabpanel" aria-labelledby="animated-underline-orders-tab">
                    <div class="row">
                        <div class="col-xl-6 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Choose Theme</h6>
                                    <div class="d-sm-flex justify-content-around">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                              <img class="ms-3" width="100" height="68" alt="settings-dark" src="{{Vite::asset('resources/images/settings-light.svg')}}">
                                            </label>
                                        </div>
                                        
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                <img class="ms-3" width="100" height="68" alt="settings-light" src="{{Vite::asset('resources/images/settings-dark.svg')}}">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Activity data</h6>
                                    <p>Download your Summary, Task and Payment History Data</p>
                                    <div class="form-group mt-4">
                                        <button class="btn btn-primary">Download Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Public Profile</h6>
                                    <p>Your <span class="text-success">Profile</span> will be visible to anyone on the network.</p>
                                    <div class="form-group mt-4">
                                        <div class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                            <input class="switch-input" type="checkbox" role="switch" id="publicProfile" checked>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Show my email</h6>
                                    <p>Your <span class="text-success">Email</span> will be visible to anyone on the network.</p>
                                    <div class="form-group mt-4">
                                        <div class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                            <input class="switch-input" type="checkbox" role="switch" id="showMyEmail">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Enable keyboard shortcuts</h6>
                                    <p>When enabled, press <code class="text-success">ctrl</code> for help</p>
                                    <div class="form-group mt-4">
                                        <div class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                            <input class="switch-input" type="checkbox" role="switch" id="EnableKeyboardShortcut">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Hide left navigation</h6>
                                    <p>Sidebar will be <span class="text-success">hidden</span> by default</p>
                                    <div class="form-group mt-4">
                                        <div class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                            <input class="switch-input" type="checkbox" role="switch" id="hideLeftNavigation">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Advertisements</h6>
                                    <p>Display <span class="text-success">Ads</span> on your dashboard</p>
                                    <div class="form-group mt-4">
                                        <div class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                            <input class="switch-input" type="checkbox" role="switch" id="advertisements">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Social Profile</h6>
                                    <p>Enable your <span class="text-success">social</span> profiles on this network</p>
                                    <div class="form-group mt-4">
                                        <div class="switch form-switch-custom switch-inline form-switch-secondary mt-1">
                                            <input class="switch-input" type="checkbox" role="switch" id="socialprofile" checked>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                                    
                    </div>
                </div>
{{-- some additional info --}}
                <div class="tab-pane fade show" id="animated-underline-notes" role="tabpanel" aria-labelledby="animated-underline-notes-tab">
                    <div class="alert alert-arrow-right alert-icon-right alert-light-warning alert-dismissible fade show mb-4" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                        <strong>Warning!</strong> Please proceed with caution. For any assistance - <a href="javascript:void(0);">Contact Us</a>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Purge Cache</h6>
                                    <p>Remove the active resource from the cache without waiting for the predetermined cache expiry time.</p>
                                    <div class="form-group mt-4">
                                        <button class="btn btn-secondary btn-clear-purge">Clear</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Deactivate Account</h6>
                                    <p>You will not be able to receive messages, notifications for up to 24 hours.</p>
                                    <div class="form-group mt-4">
                                        <div class="switch form-switch-custom switch-inline form-switch-success mt-1">
                                            <input class="switch-input" type="checkbox" role="switch" id="socialformprofile-custom-switch-success">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-4 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <h6 class="">Delete Account</h6>
                                    <p>Once you delete the account, there is no going back. Please be certain.</p>
                                    <div class="form-group mt-4">
                                        <button class="btn btn-danger btn-delete-account">Delete my account</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
{{-- @php
dd($errors);
@endphp --}}
    
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>

        <script src="{{asset('plugins/filepond/filepond.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginFileValidateType.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageExifOrientation.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImagePreview.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageCrop.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageResize.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/FilePondPluginImageTransform.min.js')}}"></script>
        <script src="{{asset('plugins/filepond/filepondPluginFileValidateSize.min.js')}}"></script>

        <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
        <script src="{{asset('plugins/sweetalerts2/sweetalerts2.min.js')}}"></script>

        @vite(['resources/assets/js/users/account-settings.js'])
        
        <script type="module">
            userProfile.addFiles("{{Vite::asset('resources/images/user-profile.jpeg')}}");




        </script>


        
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>








{{--  --}}

<h1>Single contact {{$singleContact->name}} ::: {{$singleContact->surname}}</h1>
@if($singleContact = '') 
   <h3>Ten kontakt nie ma przypisanej firmy.</h3> 
   <h4>Czy chcesz przypisac firmę do kontaktu?</h4>
@else
<h2>Ten kontakt należy do firmy: {{$company->name}}</h2>
<h4>Firma {{$company->name}} znajduje się pod adresem: </h4>
<h5> {{$companyAddress->name}}</h5>
<h5>Ulica: {{$companyAddress->street}}</h5>
<h5>Miasto: {{$companyAddress->city}}</h5>
@endif

{{-- <button><a href="{{route('contact.edit', $contact['id'])}}">Edytuj kontakt</a></button> --}}



{{-- 
 <form method="POST" action="{{route('contact.delete', $contact->id)}}">
            @csrf
            {{method_field('DELETE')}} 
            <button class="btn btn-danger mt-5" onclick="return confirm('Are you sure?')">Usuń kontakt</button>
        </form> --}}

        

         