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
                            <h4 class=" p-2 ">Dane firmy "<span>{{$company->name}}</span>"</h4>
                            <div class="row ">
                                <div  class="card p-2 mt-2 ms-5 mb-5 col-9">

<table  class="table">
  <tbody>
    <tr>
      <th style="min-width: 150px">Nazwa Firmy</th>
      <td class="border-bottom border-danger" >{{$company->name}}</td>

    </tr>
    <tr>
      <th>Telefon główny</th>
      <td>{{$company->phone}}</td>

    </tr>
    <tr>
      <th>Email główny</th>
      <td>{{$company->email}}</td>

    </tr>
    <tr>
      <th>strona www</th>
      <td>{{$company->www}}</td>

    </tr>

    <tr>
      <th>Notatki</th>
      <td class="text-wrap">{{$company->notes}} fskjdf sdjk sdkj sdkj sd k kdf jdfgkhsdkjhs kfjgklf gdl sfjldlfdjgsldfk Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quos in tempora a corrupti esse nulla praesentium laboriosam, distinctio vel.</td>

    </tr>
  </tbody>
</table>
</div>


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
        <div class="card p-2 mt-2 ms-5 mb-5 address-card">

        <table class="table">
        <tbody>
            <tr>
            <th>Nazwa Adresu</th>
            <td class="border-bottom border-danger" >{{$address->name}}</td>

            </tr>
            <tr>
            <th>Ulica</th>
            <td>{{$address->street}}</td>

            </tr>
            <tr>
            <th>Miasto</th>
            <td>{{$address->city}}</td>

            </tr>
            <tr>
            <th>Kod Pocztowy</th>
            <td>{{$address->postal_code}}</td>

            </tr>
            <tr>
            <th>Województwo</th>
            <td>{{$address->province}}</td>

            </tr>

            <tr>
            <th>Notatki</th>
            <td class="text-wrap">{{$address->notes}}</td>

            </tr>
        </tbody>
        </table>
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
                            <div class="row">
                            @foreach ($contacts as $contact )







                            {{-- <div class="card p-5 mt-2 ms-2 contact-card">
                                <h4>Imię: <span>{{$contact->name}}</span></h4>
                                <h4>Nazwisko: <span>{{$contact->surname}}</span></h4>
                                <h4>Pozycja: <span>{{$contact->position}}</span></h4>
                                <h4>email: <span>{{$contact->email}}</span></h4>
                                <h4>Telefon: <span>{{$contact->phone}}</span></h4>
                                <h4>Telefon 2: <span>{{$contact->phone_business}}</span></h4>
                                <h4>Notatki: <span>{{$contact->notes}}</span></h4>
                            </div> --}}




                            <div class="border border-custom border-info rounded p-5 ms-5 mt-2 col-xxl-4 col-xl-4 col-lg-5 col-md-5 col-sm-6 ">
                            <a href="{{route('single.contact', $contact->id)}}">
                                <table class="table">
                                <tbody>
                                    <tr>
                                    <th>Imię</th>
                                    <td class="border-bottom border-danger font-weight-bold" >{{$contact->name}}</td>

                                    </tr>
                                    <tr>
                                    <th>Nazwisko</th>
                                    <td class="border-bottom border-danger ">{{$contact->surname}}</td>

                                    </tr>
                                    <tr>
                                    <th>Pozycja</th>
                                    <td>{{$contact->position}}</td>

                                    </tr>
                                    <tr>
                                    <th>email</th>
                                    <td>{{$contact->email}}</td>

                                    </tr>
                                    <tr>
                                    <th>Telefon</th>
                                    <td>{{$contact->phone}}</td>

                                    </tr>

                                    <tr>
                                    <th>Telefon 2</th>
                                    <td>{{$contact->phone_business}}</td>

                                    </tr>

                                    <tr>
                                    <th>Notatki</th>
                                    <td class="text-wrap">{{$contact->notes}}</td>

                                    </tr>
                                </tbody>
                                </table>
                                </a>
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