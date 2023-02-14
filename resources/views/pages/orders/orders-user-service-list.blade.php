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
                <li class="breadcrumb-item"><a href="#">Zgłoszenia</a></li>
                <li class="breadcrumb-item active" aria-current="page">Zgłoszenia Serwisowe</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->



    <div class="seperator-header">
        <h4 class="">Zgłoszenia Serwisowe</h4>
        @can('is-admin')
        <a href="{{route('add.order')}}"><button class="btn btn-danger">Dodaj nowe zgłoszenie serwisowe</button></a>
        @endcan
    </div>
    
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area">
                    
                    <table class="multi-table table dt-table-hover" >
                        <thead>
                            <tr>
                                <th>Nr</th>
                                <th>Firma/Klient</th>
                                <th>Tytuł</th>
                                <th>Typ</th>
                                <th>Termin</th>
                                <th>Uwagi</th>
                                <th>Prowadzący</th>
                                <th class="text-center">Status</th>
                                <th class="text-center dt-no-sorting">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)

                            <tr >
                                <td>{{$order->id}}</td>
                                @foreach ($companies as $company)
                                    @if($order->company_id === $company->id)
                                    <td style="max-width: 5px; overflow:hidden">{{$company->name}}</td>
                                    {{-- @else
                                    <td>Brak przypisanej firmy</td> --}}
                                    @endif
                                @endforeach
                                
                                <td style="min-width: 200px; max-width: 250px; overflow:hidden">{{$order->title}}</td>

                                <td>inne</td>
                                <td>{{$order->deadline}}</td>
                                <td style="max-width: 10px; overflow: hidden;">{{$order->order_notes}}</td>

                                @foreach ($users as $user)
                                @if($order->lead_person == $user->id)
                                <td style="max-width: 10px; overflow: hidden;" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$user->name}}">{{ $user->name }}</td>
                                @endif
                                {{-- <td>{{$order->involved_person == $user->id ? $user->name : 'os nie zostala przypisana'}}</td> --}}
                                @endforeach

                                <td style=" max-width:58px; overflow:hidden">
                                    @switch($order->status)
                                        @case('anulowane')
                                            <span class="badge badge-danger mb-2 me-4">ANULOWANE</span>
                                            @break
                                        @case('nowe')
                                            <span class="badge badge-info mb-2 me-4">Nowe</span>
                                            @break
                                        @case('otwarte')
                                            <span class="badge badge-warning mb-2 me-4">Otwarte</span>
                                            @break
                                        @case('w toku')
                                            <span class="badge badge-secondary mb-2 me-4">W toku</span>
                                            @break
                                        @case('reklamacje')
                                            <span class="badge badge-dark mb-2 me-4">Reklamacje</span>
                                            @break 
                                        @case('sfinalizowane')
                                            <span class="badge badge-success mb-2 me-4">Sfinalizowane</span>
                                            @break
                                        @default
                                            <span>{{$order->status}}</span>
                                        
                                        @endswitch
                                </td>
                                <td class="text-center"> <a href="{{route('single.service.order', $order->id)}}"><button class="btn btn-primary">Otwórz</button></a>  </td>
                            </tr>



                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nr</th>
                                <th>Firma/Klient</th>
                                <th>Tytuł</th>
                                <th>Typ</th>
                                <th>Termin</th>
                                <th>Uwagi</th>
                                <th>Prowadzący</th>

                                <th class="text-center">Status</th>
                                <th class="text-center dt-no-sorting">Action</th>
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