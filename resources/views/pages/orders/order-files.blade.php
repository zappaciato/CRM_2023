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
    <a href="{{route('single.service.order' , $order->id)}}"><button>Wróć</button></a>
<h1>Order Files</h1>
<p>{{$orderFiles->count()}}</p>

@foreach($orderFiles as $file)

<p>{{$file->name}}</p>
<p>{{$file->getUrl()}}</p>
<a href="{{$file->getUrl()}}" target="_blank">{{$file->name}}</a>
{{-- <p>{{$file->getMedia()}}</p> --}}

@endforeach
<form action="{{route('add.file')}}" method="POST" enctype="multipart/form-data">

    @csrf
        <input type="hidden" name="order_id" value="{{$order->id}}">
        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">

        <label for="new_file">
        <input type="file" name="new_file">

    <button class="btn btn-primary" type="submit">Zapisz</button>

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