<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
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
                <li class="breadcrumb-item"><a href="#">Zlecenia</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nowe Zlecenia</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->



    <div class="seperator-header">
        <h4 class="">Nowe zlecenia</h4>
        <a href="{{route('add.order')}}"><button class="btn btn-danger">Dodaj nowe zlecenie</button></a>
        
    </div>
    



<div class="row">
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    
                    <table class="multi-table table dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Zamawiający</th>
                                <th>Tytuł</th>
                                <th > Data </th>
                                <th class="text-center">Status</th>
                                <th class="text-center dt-no-sorting">Akcje</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order )
                                
                            
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->company_id}}</td>
                                <td>{{$order->title}}</td>
                                <td>{{$order->date}}</td>
                                <td>
                                    <div class="t-dot bg-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-original-title="Normal"></div>
                                </td>
                                <td class="text-center"> <a href="{{route('single.email', 1)}}"><button class="btn btn-primary">Otwórz</button> </a> </td>
                            </tr>

                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Zamawiający</th>
                                <th>Tytuł</th>
                                <th > Data </th>
                                <th class="text-center">Status</th>
                                <th class="text-center dt-no-sorting">Akcje</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script src="{{asset('plugins/global/vendors.min.js')}}"></script>
        @vite(['resources/assets/js/custom.js'])
        <script src="{{asset('plugins/table/datatable/datatables.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/jszip.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
        <script src="{{asset('plugins/table/datatable/custom_miscellaneous.js')}}"></script>
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>