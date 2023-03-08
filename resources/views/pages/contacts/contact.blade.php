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

                        <link rel="stylesheet" href="{{asset('plugins/table/datatable/datatables.css')}}">
        @vite(['resources/scss/light/plugins/table/datatable/dt-global_style.scss'])
        @vite(['resources/scss/light/plugins/table/datatable/custom_dt_miscellaneous.scss'])
        @vite(['resources/scss/dark/plugins/table/datatable/dt-global_style.scss'])
        @vite(['resources/scss/dark/plugins/table/datatable/custom_dt_miscellaneous.scss'])
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
                                    {{-- <h6 class="">Informacje ogólne kontaktu</h6> --}}
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                
                                                 <div class="border border-custom border-info rounded p-5 ms-5 mt-2 col-xxl-8 col-xl-10 col-lg-10 col-md-10 col-sm-10 ">
                            <a href="{{route('single.contact', $singleContact->id)}}">
                                <h6 class="">Informacje ogólne kontaktu:</h6>
                                <table class="table">
                                <tbody>
                                    <tr>
                                    <th>Imię</th>
                                    <td class="border-bottom border-danger font-weight-bold" >{{$singleContact->name}}</td>

                                    </tr>
                                    <tr>
                                    <th>Nazwisko</th>
                                    <td class="border-bottom border-danger ">{{$singleContact->surname}}</td>

                                    </tr>
                                    <tr>
                                    <th>Pozycja</th>
                                    <td>{{$singleContact->position}}</td>

                                    </tr>
                                    <tr>
                                    <th>email</th>
                                    <td>{{$singleContact->email}}</td>

                                    </tr>
                                    <tr>
                                    <th>Telefon</th>
                                    <td>{{$singleContact->phone}}</td>

                                    </tr>

                                    <tr>
                                    <th>Telefon 2</th>
                                    <td>{{$singleContact->phone_business}}</td>

                                    </tr>

                                    <tr>
                                    <th>Notatki</th>
                                    <td class="text-wrap">{{$singleContact->notes}}</td>

                                    </tr>
                                </tbody>
                                </table>
                                </a>
                                </div>

                                                {{-- fdsfsdfsdfdsfdsfdsfds delete below --}}

                                                {{-- delete above --}}
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
                                    {{-- <h6 class="">Informacje o firmie</h6> --}}
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                {{-- delet below --}}
                                                <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="">
                                                        <div class="row">
                                                           
                            <a href="{{route('single.contact', $singleContact->id)}}">
                                <h6 class="">Informacje o firmie:</h6>
                                <table class="table">
                                <tbody>
                                    <tr>
                                    <th>Nazwa</th>
                                    <td class="border-bottom border-danger font-weight-bold" >{{$company->name}}</td>

                                    </tr>
                                    <tr>
                                    <th>NIP</th>
                                    <td class="border-bottom border-danger ">{{$company->nip}}</td>

                                    </tr>
                                    <tr>
                                    <th>email główny</th>
                                    <td>{{$company->email}}</td>

                                    </tr>
                                    <tr>
                                    <th>Kraj</th>
                                    <td>{{$company->country}}</td>

                                    </tr>
                                    <tr>
                                    <th>Telefon</th>
                                    <td>{{$company->phone}}</td>

                                    </tr>

                                    <tr>
                                    <th>Telefon 2</th>
                                    <td>{{$company->phone_stationary}}</td>

                                    </tr>

                                    <tr>
                                    <th>Notatki</th>
                                    <td class="text-wrap">{{$singleContact->notes}}</td>

                                    </tr>
                                </tbody>
                                </table>
                                </a>
                                                            
                                                            



                                <h6 class="">Informacje o adresie:</h6>
                                <table class="table">
                                <tbody>
                                    <tr>
                                    <th>Ulica</th>
                                    <td class="border-bottom border-danger font-weight-bold" >{{$companyAddress->street}}</td>

                                    </tr>
                                    <tr>
                                    <th>Miasto</th>
                                    <td class="border-bottom border-danger ">{{$companyAddress->city}}</td>

                                    </tr>
                                    <tr>
                                    <th>Kraj</th>
                                    <td>{{$companyAddress->country}}</td>

                                    </tr>
                                    <tr>
                                    <th>Notatki</th>
                                    <td class="text-wrap">{{$companyAddress->notes}}</td>

                                    </tr>
                                </tbody>
                                </table>


                                                         
                                                         

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

                            {{-- export the below as a component TODO and possibly in the controller make a service during the refactoring--}}
                            <div class=" widget box box-shadow" style="width:60vw">
                                <div class="" >

                                    @if(!$contactOrders->isNotEmpty())
                                            <h4>Firma nie ma żadnych zgłoszeń w bazie!</h4>
                                            @else

                                            <table class="multi-table table dt-table-hover" >
                                        <thead>
                                            <tr>
                                                <th>Nr</th>
                                                <th>Tytuł</th>

                                                <th>Typ</th>
                                                <th>Termin</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center dt-no-sorting">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contactOrders as $order)
                                            <tr>
                                                <td>{{$order->id}}</td>
                                                
                                                <td style="max-width: 200px; overflow:hidden">{{$order->title}}</td>

                                                <td>inne</td>
                                                <td>{{$order->deadline}}</td>
                                                
                                                <td>
                                                    <span>{{$order->status}}</span>
                                                </td>
                                                <td class="text-center"> <a href="{{route('single.service.order', $order->id)}}"><button class="btn btn-primary">Otwórz</button></a>  </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Nr</th>
                                                    <th>Tytuł</th>
                                                    <th>Typ</th>
                                                    <th>Termin</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center dt-no-sorting">Action</th>
                                                </tr>
                                            </tfoot>
                                    </table>
                                            @endif
                                    
                                    
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

 <script src="{{asset('plugins/table/datatable/datatables.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/jszip.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/custom_miscellaneous.js')}}"></script>
        <script src="{{asset('plugins/apex/apexcharts.min.js')}}"></script>
        
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>








{{--  --}}



{{-- <button><a href="{{route('contact.edit', $contact['id'])}}">Edytuj kontakt</a></button> --}}



{{-- 
 <form method="POST" action="{{route('contact.delete', $contact->id)}}">
            @csrf
            {{method_field('DELETE')}} 
            <button class="btn btn-danger mt-5" onclick="return confirm('Are you sure?')">Usuń kontakt</button>
        </form> --}}

        

         