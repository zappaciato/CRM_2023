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
    <div class="card mt-2 p-5">
    
<h5>Pliki przypisane do zgłoszenia nr: {{$order->id}} tytuł: {{$order->title}}</h5>
<h5>Liczba powiązanych plików: <span>{{$orderFiles->count()}}</span> </h5>
</div>


<table class="mt-2">
    <tr>
        <th>Nr</th>
        <th>Nazwa pliku</th>
        <th>Rozmiar</th>
        <th>Data zapisu</th>
        <th>Notatka</th>
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
            
        <td style="max-width: 500px; overflow: hidden; " >{{$comment->file_comment}} <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#commentModal{{$comment->id}}">Edytuj</button></td>
        
            @else
            {{-- <td>Brak notatki!</td> --}}
            @endif
        @endforeach
        </tr>
@php
    $counter++;
@endphp


{{-- MODAL NIE DZIALA.. cos zmienic jednak, uproscic; ! --}}

        {{-- modal for editing file Coments to be put into partials --}}
    {{-- THIS HAS TO GO TO PARTIALS LATGER MODAL FOR COMMENT FOR FILE; --}}
        <div class="modal fade" id="#commentModal{{$comment->id}}" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title add-title" id="notesMailModalTitleeLabel">Dopisz komentarz do pliku</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-bs-dismiss="modal"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg> -->
                                    <div class="compose-box">
                                        <div class="compose-content">
                                            <form id="message-to-client-form" class="row g-3 needs-validation" action="#" method="POST" novalidate enctype="multipart/form-data">
                                            @csrf    
                                                
                                                <div class="message-content">
                                                     <p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> Treść:</p>
                                                    <textarea  class="" name="file_comment" id="message-content" cols="58" rows="10" required >Plik odnosi sie do zgłoszenia: {{$order->title}} {{$comment->file_comment}}</textarea>
                                                    
                                                </div>

                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {{-- <button id="btn-save" class="btn float-left btn-success"> Zapisz</button>
                                    <button class="btn" data-bs-dismiss="modal"> <i class="flaticon-delete-1"></i> Anuluj</button> --}}
                                    <button type="submit" value="submit" id="btn-send" class="btn btn-primary"> Wyślij</button>
                                </div>
                                
                                {{-- @php
                                    dd($errors);
                                @endphp --}}
                                </form>
                            </div>
                        </div>
                    </div>

        {{-- endof modal for edidty file comments --}}


           
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