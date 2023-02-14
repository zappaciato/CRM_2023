<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
        <link rel="stylesheet" href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/sweetalerts2/sweetalerts2.css')}}">
        @vite(['resources/scss/light/assets/components/modal.scss'])
        @vite(['resources/scss/light/plugins/editors/quill/quill.snow.scss'])
        @vite(['resources/scss/light/assets/apps/mailbox.scss'])
        @vite(['resources/scss/light/plugins/sweetalerts2/custom-sweetalert.scss'])

        @vite(['resources/scss/dark/assets/components/modal.scss'])
        @vite(['resources/scss/dark/plugins/editors/quill/quill.snow.scss'])
        @vite(['resources/scss/dark/assets/apps/mailbox.scss'])
        @vite(['resources/scss/dark/plugins/sweetalerts2/custom-sweetalert.scss'])
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

<div class="d-flex column container card layout-top-spacing">
<h1>Send email</h1>
<form class="row g-3 needs-validation" action="{{route('create.email')}}" method="POST" novalidate enctype="multipart/form-data">
        @csrf     
    <div class="d-flex row">
        <div class="column">
    <input type="hidden" name="message_id" placeholder="message ID" value="a87ff679a2f3e71d9181a67b7542122c@marex.pl">
    <input type="hidden" name="headers_raw"placeholder="headers_raw" value="header_row_007">
    <input type="hidden" name="headers"placeholder="headers" value="skomopikwane dane">
    <input type="text" name="from_name"placeholder="from_name" value="{{old('from_name')}}">
    </div>
    <div class="column">
    <input type="text" name="from_address"placeholder="from_address">
    <input type="text" name="subject"placeholder="subject"value="{{old('subject')}}">
    <input type="hidden" name="to"placeholder="to" value="perfectu@wop.pl">
    <input type="hidden" name="to_string"placeholder="to_string" value="serwis@perfect-cut.pl ">
    </div>
    <div class="column">
    <input type="hidden" name="cc"placeholder="cc" value="henry@k.pl">
    <input type="hidden" name="bcc"placeholder="bcc" value="mariola@k.pl">
    <textarea type="text" name="text_plain"placeholder="text_plain" value="{{old('text_plain')}}"></textarea>
    <textarea type="hidden" name="text_html"placeholder="text_html" value="<h1>Oto text htmal</h1>
    <h4>Mozna mniesza czcionka</h4>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deserunt voluptatum consequuntur, quis impedit placeat accusamus cum nemo quisquam hic soluta.</p>"></textarea>
    </div>
    <div class="column">
    <input type="date" name="date"placeholder="date" value="{{old('date')}}">
    <input type="hidden" name="emailstatus"placeholder="emailstatus" value="new">
    <input type="hidden" name="user_id" value="1">
    </div>
    <input type="file" name="e-attachment" placeholder="Give me some files!" >
</div>
    <button class="btn btn-lg btn-primary" type="submit">Wyślij</button>

    


</form>
</div>

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        <script src="{{asset('plugins/global/vendors.min.js')}}"></script>
        <script src="{{asset('plugins/editors/quill/quill.js')}}"></script>
        <script src="{{asset('plugins/sweetalerts2/sweetalerts2.min.js')}}"></script>
        <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
        @vite(['resources/assets/js/apps/mailbox.js'])
    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>