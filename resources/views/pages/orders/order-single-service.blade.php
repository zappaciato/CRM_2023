<x-base-layout :scrollspy="false">

    <x-slot:pageTitle>
        {{$title}} 
    </x-slot>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-slot:headerFiles>
        <!--  BEGIN CUSTOM STYLE FILE  -->
    {{-- for timeline --}}
        @vite(['resources/scss/light/assets/components/timeline.scss'])
        @vite(['resources/scss/dark/assets/components/timeline.scss'])
        <!--  END CUSTOM STYLE FILE  -->
        {{-- from post blog --}}
        @vite(['resources/scss/light/assets/elements/custom-pagination.scss'])
        @vite(['resources/scss/light/assets/apps/blog-post.scss'])
        @vite(['resources/scss/dark/assets/elements/custom-pagination.scss'])
        @vite(['resources/scss/dark/assets/apps/blog-post.scss'])
        <style>
            .toggle-code-snippet { margin-bottom: 0px; }
            body.dark .toggle-code-snippet { margin-bottom: 0px; }
        </style>
{{-- end for timeline --}}


        <link rel="stylesheet" href="{{asset('plugins/apex/apexcharts.css')}}">

        @vite(['resources/scss/light/assets/components/list-group.scss'])
        @vite(['resources/scss/light/assets/widgets/modules-widgets.scss'])

        @vite(['resources/scss/dark/assets/components/list-group.scss'])
        @vite(['resources/scss/dark/assets/widgets/modules-widgets.scss'])

        @vite(['resources/scss/light/assets/elements/alert.scss'])
        @vite(['resources/scss/dark/assets/elements/alert.scss'])

        <link rel="stylesheet" href="{{asset('plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/glightbox/glightbox.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/splide/splide.min.css')}}">

        @vite(['resources/scss/light/assets/components/tabs.scss'])
        @vite(['resources/scss/light/assets/components/accordions.scss'])
        @vite(['resources/scss/light/assets/apps/ecommerce-details.scss'])
        @vite(['resources/scss/dark/assets/components/tabs.scss'])
        @vite(['resources/scss/dark/assets/components/accordions.scss'])
        @vite(['resources/scss/dark/assets/apps/ecommerce-details.scss'])   
        <!--  END CUSTOM STYLE FILE  -->

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

        @vite(['resources/scss/light/assets/elements/infobox.scss', 'resources/scss/dark/assets/elements/infobox.scss'])

        @vite(['resources/scss/light/assets/components/accordions.scss'])
        @vite(['resources/scss/dark/assets/components/accordions.scss'])
        <!--  END CUSTOM STYLE FILE  -->
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BREADCRUMB -->
<div class="page-meta">

    <nav class="breadcrumb-style-one" aria-label="breadcrumb">

        {{-- Send message modal START --}}
        @include('partials.order-send-message-modal')

    </nav>

        {{-- Action buttons --}}
    <div class="d-flex justify-content-between">

            @include('partials.order-action-btns')

    </div>

    {{-- main single order info --}}
    <div class="d-flex">
            @include('partials.order-main-info')
    </div>

</div>
    <!-- /BREADCRUMB -->

    
<div class="row layout-top-spacing">
    <div class="col-md-12">
        <div class="row ">
            {{-- General info data display --}}
            @include('partials.order-data-display')

        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">

            <div class="widget-content widget-content-area br-8">
                {{-- Timeline display --}}
                @include('partials.order-timeline')

            </div>   

        </div>
            {{-- comments display --}}
            @include('partials.order-comments')

    </div>
</div>

{{-- @php
    var_dump($emailsAssigned);
@endphp --}}

    
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <x-slot:footerFiles>
        {{-- mialo niby pomoc zeby nie scrollowalo w gore ale nie dziala przy paginacji --}}
    <script>
$('a[href="#highlights"]').click(function() {
    $('html, body').animate({
        scrollTop: $("#highlights").offset().top
    }, 1000);
  });
</script>





        <script src="{{asset('plugins/global/vendors.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
        <script src="{{asset('plugins/glightbox/glightbox.min.js')}}"></script>
        <script src="{{asset('plugins/splide/splide.min.js')}}"></script>
        @vite(['resources/assets/js/apps/ecommerce-details.js'])

        <script src="{{asset('plugins/apex/apexcharts.min.js')}}"></script>
        {{-- <script src="{{asset('plugins/apex/custom-apexcharts.js')}}"></script> --}}
        @vite(['resources/assets/js/widgets/modules-widgets.js'])
        

        <script src="{{asset('plugins/global/vendors.min.js')}}"></script>
        <script src="{{asset('plugins/editors/quill/quill.js')}}"></script>
        <script src="{{asset('plugins/sweetalerts2/sweetalerts2.min.js')}}"></script>
        <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
        
        {{-- for order message --}}
        @vite(['resources/assets/js/apps/mailbox.js'])

{{-- TODO: Tutaj chce zeby nie przeładowywalo okna modal przed skonczeniem validacji i podaniem błędów. Nie działa w ten sposonb;  --}}
        <script>
$('#message-to-client-form').submit(function(){

var url = {{ route('message.to.client', $singleOrder->id) }};
var data = $('#message-to-client-form').serialize();
e.preventDefault();
$.post(url, data, function(response){
    if(response.success)
    {
        // Print success message and close modal
    }
    else
    {
        $('#message-to-client-form errorList').html(JSON.stringify(response.errors));
    }
});


// return false to stop the normal submission
return false;
});
</script>
{{-- And of script for validation errors message no page refresh --}}

    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>