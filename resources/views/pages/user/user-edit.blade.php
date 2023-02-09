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
                <li class="breadcrumb-item"><a href="#">Użytkownik</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dane i ustawienia</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
        
    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="row mb-3">
                <div class="col-md-12">
                    <h2>Dane</h2>
{{-- the tabls should be disabled here but it doesn't work the usual way --}}
                    <ul class="nav nav-pills" id="animateLine" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="animated-underline-home-tab" data-bs-toggle="tab" href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Dane osobowe</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button  class="nav-link" id="animated-underline-profile-tab" data-bs-toggle="tab" href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile" aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" disabled></path></svg> Zaangażowany w zadania</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-preferences-tab" data-bs-toggle="tab" href="#animated-underline-preferences" role="tab" aria-controls="animated-underline-preferences" aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4" disabled></circle></svg> Inne</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="animated-underline-contact-tab" data-bs-toggle="tab" href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact" aria-selected="false" tabindex="-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" disabled></path></svg> Blokady</button>
                        </li>
                    </ul>
                </div>
            </div>

            @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
        </div>
        @endif

        <!-- Way 1: Display All Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <div class="tab-content" id="animateLineContent-4">
                <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel" aria-labelledby="animated-underline-home-tab">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section general-info" method="POST" action="{{ route('user.edit', $user->id) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">

                                <input type="hidden" name="password" value="{{$user->password}}">


                                <div class="info">
                                    <h6 class="">Informacje ogólne</h6>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-12 col-md-4">
                                                    <div class="profile-image  mt-4 pe-md-4">

                                                        <!-- // The classic file input element we'll enhance
                                                        // to a file pond, we moved the configuration
                                                        // properties to JavaScript -->
                                                        
                                    {{-- do uploadu plików??? --}}
                                                        {{-- <div class="img-uploader-content">
                                                            <input type="file" class="filepond"
                                                                name="filepond" accept="image/png, image/jpeg, image/gif"/>
                                                        </div> --}}
                                    
                                                    </div>
                                                </div>

                                                <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="fullName">Imię i Nazwisko</label>
                                                                    <input type="text" class="form-control mb-3" id="name" name="name" placeholder="Full Name" value="{{$user->name}}">
                                                                </div>
                                                            </div>
                                                <div class="col-md-6">
                                                    <label for="role" class="form-label">Rola</label>
                                                        <select  id="role" name="role" class="form-select" >
                                                            @if($user->role == 'admin')
                                                            <option value="nieprzypisany">Nieprzypisany</option>
                                                            <option selected value="admin">Administrator</option>
                                                            <option value="konstruktor">Konstruktor</option>
                                                            @elseif ($user->role == 'nieprzypisany')
                                                            <option selected value="nieprzypisany">Nieprzypisany</option>
                                                            <option  value="admin">Administrator</option>
                                                            <option value="konstruktor">Konstruktor</option>
                                                            @endif
                                                        </select>
                                                </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="phone">Telefon</label>
                                                                    <input type="text" name="phone" class="form-control mb-3" id="phone" placeholder="Write your phone number here" value="{{$user->phone}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email">Email</label>
                                                                    <input type="text" class="form-control mb-3" id="email" name="email" placeholder="Write your email here" value="{{$user->email}}">
                                                                </div>
                                                            </div>    
                                                            
                                                            <div class="form-fieldset col-md-12">
                                <label for="image" class="form-label">Dodaj zdjęcie:</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                          
                                                            {{-- <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="website1">Website</label>
                                                                    <input type="text" class="form-control mb-3" id="website1" placeholder="Enter URL">
                                                                </div>
                                                            </div> --}}

                                                            {{-- <div class="col-md-12 mt-1">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="" id="customCheck1">
                                                                    <label class="form-check-label" for="customCheck1">Make this my default address</label>
                                                                </div>
                                                            </div> --}}

                                                            <div class="col-md-12 mt-1">
                                                                <div class="form-group text-end">
                                                                    <button type="submit" class="btn btn-secondary">Save</button>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
                <div class="tab-pane fade" id="animated-underline-profile" role="tabpanel" aria-labelledby="animated-underline-profile-tab">
                    <div class="row">
                        {{-- @foreach($userCurrentOrders as $order)
                        <div class="col-xl-6 col-lg-12 col-md-12 layout-spacing">
                                <div class="container card p-2">
                                <p>Numer id:</p><h4>{{$order->id}} </h4>
                                <p class="ms-5">{{$order->title}} <a href="{{route('single.service.order', $order->id)}}"><button class="btn btn-success ms-5">Pokaż</button></a> </p>
                                <p>{{$order->order_content}}</p>
                                @if($order->involved_person == $user->id)
                                <h6>Zaagnażowany jako: <strong>Os. zaangalżwoana</strong></h6>
                                @elseif ($order->lead_person == $user->id)
                                <h6>Zaagnażowany jako: <strong>Os. Odpowiedzialna</strong></h6>
                                @endif
                            </div>
                        </div>
                        @endforeach --}}
                </div>

                <div class="tab-pane fade" id="animated-underline-preferences" role="tabpanel" aria-labelledby="animated-underline-preferences-tab">
                    <div class="row">
                        <div class="col-xl-6 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">

                            </div>
                        </div>
                                    
                    </div>
                </div>
                <div class="tab-pane fade" id="animated-underline-contact" role="tabpanel" aria-labelledby="animated-underline-contact-tab">
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