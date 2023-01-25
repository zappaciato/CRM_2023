

<x-base-layout-guest :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        @vite(['resources/scss/light/assets/authentication/auth-cover.scss'])
        @vite(['resources/scss/dark/assets/authentication/auth-cover.scss'])
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <div class="auth-container d-flex">
        <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7  d-flex flex-column align-self-center mx-auto">
            <div class="card">
                <div class="card-body">
<form action="/register" method="POST" enctype="multipart/form-data">
        @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            
                            <h2>Zarejestruj się</h2>
                            <p>Podaj swoje dane do rejestracji</p>
                            
                        </div>


                        
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">Imię</label>
                                <input type="text" id="name" class="form-control add-billing-address-input" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>


                        {{-- <div class="col-md-12">
                            <div class="mb-3">
                                <label for="surname" class="form-label">Nazwisko</label>
                                <input id="surname" type="text" class="form-control add-billing-address-input" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>
                            </div>

                                @error('surname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div> --}}


                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-12">
                                <input id="role" type="hidden" value="nieprzypisany" class="form-control" name="role">
                            
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telefon</label>
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                            </div>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-fieldset col-md-12">
                <label for="image" class="form-label">Dodaj zdjęcie:</label>
                <input type="file" name="image" class="form-control">
            </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        {{-- <div class="col-12">
                            <div class="mb-3">
                                <div class="form-check form-check-primary form-check-inline">
                                    <input class="form-check-input me-3" type="checkbox" id="form-check-default">
                                    <label class="form-check-label" for="form-check-default">
                                        I agree the <a href="javascript:void(0);" class="text-primary">Terms and Conditions</a>
                                    </label>
                                </div>
                            </div>
                        </div> --}}
                        
                        <div class="col-12">
                            <div class="mb-4 mt-5">
                                <button type="submit" class="btn btn-secondary w-100">ZAREJESTRUJ SIĘ</button>
                            </div>
                        </div>
                        
                        {{-- <div class="col-12 mb-4">
                            <div class="">
                                <div class="seperator">
                                    <hr>
                                    <div class="seperator-text"> <span>Or continue with</span></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-4 col-12">
                            <div class="mb-4">
                                <button class="btn  btn-social-login w-100 ">
                                    <img src="{{Vite::asset('resources/images/google-gmail.svg')}}" alt="" class="img-fluid">
                                    <span class="btn-text-inner">Google</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-sm-4 col-12">
                            <div class="mb-4">
                                <button class="btn  btn-social-login w-100">
                                    <img src="{{Vite::asset('resources/images/github-icon.svg')}}" alt="" class="img-fluid">
                                    <span class="btn-text-inner">Github</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-sm-4 col-12">
                            <div class="mb-4">
                                <button class="btn  btn-social-login w-100">
                                    <img src="{{Vite::asset('resources/images/twitter.svg')}}" alt="" class="img-fluid">
                                    <span class="btn-text-inner">Twitter</span>
                                </button>
                            </div>
                        </div> --}}

                        <div class="col-12">
                            <div class="text-center">
                                <p class="mb-0">Masz już konto? <a href="{{route('login')}}" class="text-warning">Zaloguj się</a></p>
                            </div>
                        </div>
                        
                    </div>
</form>
                </div>
            </div>
        </div>
    </div>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>

    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout-guest>
