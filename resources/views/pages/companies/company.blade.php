<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{asset('plugins/apex/apexcharts.css')}}">

        @vite(['resources/scss/light/assets/components/tabs.scss'])
        @vite(['resources/scss/dark/assets/components/tabs.scss'])

        @vite(['resources/scss/light/assets/components/list-group.scss'])
        @vite(['resources/scss/light/assets/widgets/modules-widgets.scss'])

        @vite(['resources/scss/dark/assets/components/list-group.scss'])
        @vite(['resources/scss/dark/assets/widgets/modules-widgets.scss'])

        @vite(['resources/scss/light/assets/elements/alert.scss'])
        @vite(['resources/scss/dark/assets/elements/alert.scss'])

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
                <li class="breadcrumb-item"><a href="#">Firmy</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$company->name}}</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
<div id="tabsSimple" class="col-xl-12 col-12 layout-spacing">
    <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 p-2 d-flex">
                            <h4 class="p-2 me-5">{{$company->name}}</h4>
                            <a class="me-5" href="{{route('company.list')}}"><button class="btn btn-success">Wróć</button></a>

                            <a href="{{route('company.edit', $company->id)}}"><button class="btn btn-warning">Edytuj</button></a>

                            {{-- <a href="{{route('company.list')}}"><button class="btn btn-danger">Skasuj</button></a> --}}

                            <form class="mx-5" method="POST" action="{{ route('company.delete', $company->id) }}">
                                @csrf
                                {{method_field('DELETE')}} 
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Usuń Firmę</button>
                            </form>
                        </div>
                    </div>
                </div>


        <div class="widget-content widget-content-area">

            <div class="vertical-pill">
                        
                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Dane</button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Adresy</button>
                        <button class="nav-link" id="v-pills-contact-tab" data-bs-toggle="pill" data-bs-target="#v-pills-contact" type="button" role="tab" aria-controls="v-pills-contact" aria-selected="false">Kontakty</button>
                        <button class="nav-link" id="v-pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#v-pills-disabled" type="button" role="tab" aria-controls="v-pills-disabled" aria-selected="false" >Histora zgłoszeń</button>
                        
                    </div>


                    <div class="tab-content" id="v-pills-tabContent">

                        <div class="tab-pane fade show active " id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                            <h5 class="mb-2  ">Dane firmy</h5>
                            <div class="company-card p-5 mt-2">
                            <h4>Nazwa: <span>{{$company->name}}</span></h4>
                            <h4>Telefon: <span>{{$company->phone}}</span></h4>
                            <h4>email: <span>{{$company->email}}</span></h4>
                            <h4>Strona www: <span>{{$company->www}}</span></h4>

                            </div>
                            {{-- <h4>Notatki: <span>{{$company->notes}}</span></h4> --}}
                        </div>


                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">

                                    @if(!$addresses->isNotEmpty()) 
                                        <h5>Adresy:</h5>
                                        <h4>Adres nie został dodany do firmy. </h4>
                            {{-- TODO tu mozna zrobic jako modal - > form --}}
                                        <a href="{{route('addess.add.inCompany')}}"><button class="btn btn-info">Dodaj nowy adres do firmy</button></a>
                                    
                                    @else 

                                    <h5>Adresy:</h5>

                                    {{-- TODO tu mozna zrobic jako modal - > form --}}
                                        <a href="{{route('addess.add.inCompany')}}"><button class="btn btn-info">Dodaj nowy adres do firmy</button></a>
                                    
                                    @foreach ($addresses as $address)
                                    <div class="card p-5 mt-2 address-card">
                                        <h4>Nazwa: <span>{{$address->name}}</span></h4>
                                        <h4>Miasto: <span>{{$address->city}}</span></h4>
                                        <h4>Ulica: <span>{{$address->street}}</span></h4>
                                        <h4>Kod pocztowy: <span>{{$address->postal_code}}</span></h4>
                                        <h4>województwo: <span>{{$address->province}}</span></h4>
                                        
                                        <h4>Notatki: <span>{{$address->notes}}</span></h4>
                                    </div>
                                    @endforeach
                                        
                                    @endif

                        </div>

                        <div class="tab-pane fade" id="v-pills-disabled" role="tabpanel" aria-labelledby="v-pills-disabled-tab" tabindex="0">
                            {{-- export the below as a component TODO --}}
                            <div class=" widget box box-shadow" style="width:60vw">
                                <div class="" >

                                    @if(!$orders->isNotEmpty())
                                            <h4>Firma nie ma żadnych zgłoszeń w bazie!</h4>
                                            @else

                                            <table class="multi-table table dt-table-hover" >
                                        <thead>
                                            <tr>
                                                <th>Nr</th>
                                                <th>Tytuł</th>

                                                <th>Typ</th>
                                                <th>Termin</th>
                                                <th>Email</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center dt-no-sorting">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                            <tr>
                                                <td>{{$order->id}}</td>
                                                
                                                <td style="max-width: 200px; overflow:hidden">{{$order->title}}</td>

                                                <td>inne</td>
                                                <td>{{$order->deadline}}</td>
                                                <td>p.opechowski@loopus.pl</td>
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
                                                    <th>Email</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center dt-no-sorting">Action</th>
                                                </tr>
                                            </tfoot>
                                    </table>
                                            @endif
                                    
                                    
                                </div>
                            </div>                    
                        </div>


                        <div class="tab-pane fade" id="v-pills-contact" role="tabpanel" aria-labelledby="v-pills-contact-tab" tabindex="0">

                            @if(!$contacts->isNotEmpty()) 
                                <h5>Kontakty:</h5>
                                <h4>Kontakt nie został dodany do firmy. </h4>
                                <a href="{{route('contact.add')}}"><button class="btn btn-info">Dodaj kontakt do firmy</button></a>
                            
                            @else 
                            <h5>Kontakty:</h5>
                            <a href="{{route('contact.add')}}"><button class="btn btn-info">Dodaj nowy kontakt do firmy</button></a>
                            <div class="d-flex flex-row flex-wrap">
                            @foreach ($contacts as $contact )
                            <div class="card p-5 mt-2 ms-2 contact-card">
                                <h4>Imię: <span>{{$contact->name}}</span></h4>
                                <h4>Nazwisko: <span>{{$contact->surname}}</span></h4>
                                <h4>Pozycja: <span>{{$contact->position}}</span></h4>
                                <h4>email: <span>{{$contact->email}}</span></h4>
                                <h4>Telefon: <span>{{$contact->phone}}</span></h4>
                                <h4>Telefon 2: <span>{{$contact->phone_business}}</span></h4>
                                {{-- <h4>Notatki: <span>{{$contacts[0]->notes}}</span></h4> --}}
                            </div>
                            @endforeach  
                            </div>                                             
                            
                            @endif

                        </div>

                    </div>
                </div>
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
        <script src="{{asset('plugins/apex/apexcharts.min.js')}}"></script>
        {{-- <script src="{{asset('plugins/apex/custom-apexcharts.js')}}"></script> --}}
        @vite(['resources/assets/js/widgets/modules-widgets.js'])

    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>