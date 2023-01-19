<x-base-layout-guest :scrollspy="false">

    <x-slot:pageTitle>
        {{$title = 'Forbidden'}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        @vite(['resources/scss/light/assets/pages/error/error.scss'])
        @vite(['resources/scss/dark/assets/pages/error/error.scss'])
        <!--  END CUSTOM STYLE FILE  -->

        <style>
            body.layout-dark .theme-logo.dark-element {
                display: inline-block;
            }
            .theme-logo.dark-element {
                display: none;
            }
            body.layout-dark .theme-logo.light-element {
                display: none;
            }
            .theme-logo.light-element {
                display: inline-block;
            }
        </style>
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    <div class="container-fluid error-content mt-5  ">
        <div class="d-flex justify-content-center flex-column align-items-center mt-5">
            <h1 class="error-number mt-5">404</h1>
            <p class="mini-text">Ooops!</p>
            <p class="error-text mb-5 mt-1">Page not found!</p>
            <img src="{{Vite::asset('resources/images/error.svg')}}" alt="cork-admin-404" class="error-img-custom">
            <a href="/" class="btn btn-dark mt-5">Go Back</a>
        </div>
    </div>   

    
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>

    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout-guest>
@section('message', __($exception->getMessage() ?: 'Forbidden'))
