<x-base-layout-guest :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{asset('plugins/apex/apexcharts.css')}}">

        @vite(['resources/scss/light/assets/components/list-group.scss'])
        @vite(['resources/scss/light/assets/widgets/modules-widgets.scss'])

        @vite(['resources/scss/dark/assets/components/list-group.scss'])
        @vite(['resources/scss/dark/assets/widgets/modules-widgets.scss'])

        @vite(['resources/scss/light/assets/elements/alert.scss'])
        @vite(['resources/scss/dark/assets/elements/alert.scss'])
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!-- BREADCRUMB -->

    <div  class="welcome-screen">
        <h3 class="welcome-msg">Witaj w CRM PerfectCut</h3>
        <div class="d-flex flex-direction-row">
        @auth
                        <a href="{{ route('analytics') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class=""><button class="btn btn-success mb-2 me-4">Zaloguj się</button></a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class=""><button class="btn btn-warning mb-2 me-4">Zarejestruj się</button></a>
                        @endif
                    @endauth
            </div>
    </div>
    @php


if (Auth()->user() !== null) {


$loggedUser = Auth()->user()->name;
} else {

    $loggedUser = "Zupełnie nikt!";
}

// $route = Route::current();
// $name = Route::currentRouteName();
// $action = Route::currentRouteAction();

// echo $route;

// echo Request->route()->getName();







            @endphp

<h1>The user who is logged in is: {{$loggedUser}}</h1>

<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
</form>
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>

        {{-- <script src="{{asset('plugins/apex/apexcharts.min.js')}}"></script> --}}
        {{-- <script src="{{asset('plugins/apex/custom-apexcharts.js')}}"></script> --}}
        {{-- @vite(['resources/assets/js/widgets/modules-widgets.js']) --}}

    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout-guest>