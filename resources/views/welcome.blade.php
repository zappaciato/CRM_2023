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
    
    <div  class="container welcome-screen">
        <h3 class="welcome-msg">Witaj w CRM PerfectCut</h3>
        <div class="d-flex flex-direction-row">
        <button class="btn btn-success mb-2 me-4"> <a href="{{route('signin')}}">Zaloguj się</a> </button>
        <button class="btn btn-warning mb-2 me-4"><a href="{{route('signup')}}">Zarejestruj się</a></button>
            </div>
    </div>
    
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>

        {{-- <script src="{{asset('plugins/apex/apexcharts.min.js')}}"></script> --}}
        {{-- <script src="{{asset('plugins/apex/custom-apexcharts.js')}}"></script> --}}
        {{-- @vite(['resources/assets/js/widgets/modules-widgets.js']) --}}

    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout-guest>