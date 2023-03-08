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
        @vite(['resources/scss/dark/assets/components/modal.scss'])
        @vite(['resources/scss/light/assets/components/modal.scss'])
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>

    <div class="layout-top-spacing ">
    <a  href="{{route('single.service.order' , $order->id)}}"><button class="btn btn-success">Wróć</button></a>
    </div>
<div class="border d-flex justify-content-evenly w-100 layout-top-spacing py-5 bg-dark text-bright rounded comment-text-area-custom">    
<h5 class="text-white">Pliki przypisane do zgłoszenia nr: {{$order->id}} tytuł: {{$order->title}}</h5>
<h5 class="text-warning">Liczba powiązanych plików: <span>{{$orderFiles->count()}}</span> </h5>
</div>


<table  style="min-width: 1435px" class="mt-2">
    <tr>
        <th>Nr</th>
        <th>Nazwa pliku</th>
        <th>Rozmiar</th>
        <th>Data zapisu</th>
        <th>Notatka</th>
        <th>Edycja</th>
    </tr>
    
@php
    $counter = 1;
@endphp
@foreach($orderFiles as $file)
        <tr>
        <td>{{$counter}}</td>
        <td> <a href="{{$file->getUrl()}}" target="_blank">{{$file->name}}</a> </td>
        <td>{{$file->size}}</td>
        <td>{{$file->created_at}}</td>


        @foreach($fileComments as $comment)
            @if($comment->media_id == $file->id)
            
        <td style="max-width: 500px; overflow: hidden; " >{{$comment->file_comment}} </td>
        <td> <a href="{{route('edit.assigned.file', $comment->id)}}"> <button class="btn btn-success" >Edytuj</button></a></td> 
        
            @else
            {{-- <td>Brak notatki!</td> --}}
            @endif
        @endforeach
        </tr>
@php
    $counter++;
@endphp

@endforeach
    

</table>



<form class="mt-5" action="{{route('add.file')}}" method="POST" enctype="multipart/form-data">

    @csrf
        <input type="hidden" name="order_id" value="{{$order->id}}">
        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">

        <label for="new_file">
        <input class="btn btn-danger" type="file" name="new_file">
        <textarea name="file_comment" class="form-control comment-text-area-custom mt-2" cols="20" rows="5" placeholder="Dodaj notatkę do pliku..."></textarea>

    <button class="btn btn-primary mt-2" type="submit">Zapisz</button>

</form>

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