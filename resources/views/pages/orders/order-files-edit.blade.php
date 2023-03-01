<x-base-layout :scrollspy="false">
       <x-slot:pageTitle>
        {{$title="Edit File"}} 
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
    <a  href="{{url()->previous()}}"><button class="btn btn-success">Wróć</button></a>
    </div>
<div class="border d-flex justify-content-evenly layout-top-spacing  bg-dark text-bright rounded comment-text-area-custom">  
<h4 class="my-5 text-white">Dodaj komentarz do pliku:</h4>
</div>
<div class="d-flex justify-content-center">
    
<form class="mt-2" action="{{route('edit.assigned.file', $comment->id)}}" method="POST" enctype="multipart/form-data">

    @csrf
        <input type="hidden" name="_method" value="PUT">
        <textarea name="file_comment" class="form-control comment-text-area-custom mt-2" cols="80" rows="5" >{{$comment->file_comment}}</textarea>

    <button class="btn btn-primary mt-2" type="submit">Zapisz</button>

</form>
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
</x-base-layout>