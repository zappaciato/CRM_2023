<x-base-layout :scrollspy="false">

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
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Firmy</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$company->name}}</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    
    <div class="row layout-top-spacing">

        <div class="col-12">

            <h1>Dane firmy</h1>

            <h4>Nazwa: <span>{{$company->name}}</span></h4>
            <h4>Telefon: <span>{{$company->phone}}</span></h4>
            <h4>email: <span>{{$company->email}}</span></h4>
            <h4>Strona www: <span>{{$company->www}}</span></h4>
            <h4>Notatki: <span>{{$company->notes}}</span></h4>

            <a href="{{route('company.list')}}"><button class="btn btn-success">Wróć</button></a>

            <a href="{{route('company.edit', $company->id)}}"><button class="btn btn-warning">Edytuj</button></a>

            {{-- <a href="{{route('company.list')}}"><button class="btn btn-danger">Skasuj</button></a> --}}


            <div class="rte mt">
            <h1>Delete company</h1>
        </div>
        <form method="POST" action="{{ route('company.delete', $company->id) }}">
            @csrf
            {{method_field('DELETE')}} 
            <button class="button button-danger" onclick="return confirm('Are you sure?')">Delete post</button>
        </form>


        </div>

        <div class="col-md-12">
        </div>
        
    </div>
    
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>

        <script src="{{asset('plugins/apex/apexcharts.min.js')}}"></script>
        {{-- <script src="{{asset('plugins/apex/custom-apexcharts.js')}}"></script> --}}
        @vite(['resources/assets/js/widgets/modules-widgets.js'])

    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>