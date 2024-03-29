



<x-base-layout :scrollspy="false">

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

        <div class="container mx-auto align-self-center">
    <form action="/login" method="POST">
        @csrf
            <div class="row">
    
                <div class="col-6 d-lg-flex d-none h-100 my-auto top-0 start-0 text-center justify-content-center flex-column">
                    <div class="auth-cover-bg-image"></div>
                    <div class="auth-overlay"></div>
                        
                    <div class="">
    
                        <div class="position-relative">
    
                            {{-- <img src="{{Vite::asset('resources/images/wykrojniki.jpg')}}" alt="auth-img"> --}}
                            <h1 class="text-white px-2">PerfectCut</h1>
                            <h2 class="mt-5 text-white font-weight-bolder px-2">Wycinamy jak się patrzy</h2>
                            <p class="text-white px-2">juz od lat!</p>
                        </div>
                        
                    </div>

                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center ms-lg-auto me-lg-0 mx-auto">
                    <div class="card">
                        <div class="card-body">
    
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    
                                    <h2>Zaloguj się</h2>
                                    <p>Wpisz swój adres email i hasło żeby się zalogować</p>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="email" class="form-label" >Email</label>
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Hasło</label>
                                        <input type="password" class="form-control" id="password" type="password" name="password" required autocomplete="current-password">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <div class="form-check form-check-primary form-check-inline">
                                            <input class="form-check-input me-3" type="checkbox" id="form-check-default">
                                            <label class="form-check-label" for="form-check-default">
                                                Zapamiętaj mnie
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tutaj powinno sie znaleźć jeszcze forgot your password TODO --}}
                                
                                <div class="col-12">
                                    <div class="mb-4 mt-5">
                                        <button type="submit" class="btn btn-secondary w-100">ZALOGUJ SIĘ</button>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="text-center">
                                        <p class="mb-0">Nie masz konta? <a href="{{route('register')}}" class="text-warning">Zarejestruj się</a></p>
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

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>

    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>