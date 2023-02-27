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

    <div class="layout-top-spacing mt-5">
    <a  href="{{route('single.service.order' , $order->id)}}"><button class="btn btn-success">Wróć</button></a>
    </div>

<div class="border d-flex justify-content-evenly w-100 layout-top-spacing py-5 bg-dark text-bright rounded comment-text-area-custom">
<h5 class="text-white">Emaile przypisane do zgłoszenia nr: {{$order->id}} tytuł: {{$order->title}}</h5>
<h5 class="text-warning">Liczba powiązanych emaili: <span>{{$emails->count()}}</span> </h5>
</div>


<table class="mt-2">
    <tr>
        <th>Nr</th>
        <th>Tytuł emaila</th>
        <th>Nadawca</th>
        <th>Data zapisu</th>
        <th>Notatka</th>
    </tr>
    
@php
    $counter = 1;
@endphp
@foreach($emails as $email)
        <tr>
        <td>{{$counter}}</td>
        <td> <a href="{{route('single.email', $email->id)}}" target="_blank">{{$email->subject}}</a> </td>
        <td>{{$email->from_name}}</td>
        <td>{{$email->created_at}}</td>
        <td>Notatka do pliku</td>
        </tr>
@php
    $counter++;
@endphp
@endforeach
    

</table>



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
</x-base-layout>