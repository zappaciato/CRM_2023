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
    </x-slot>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Zlecenie nr {{$singleOrder->id}}</a></li>
            </ol>
            
            
        </nav>
        <a href="{{route('service.orders')}}"><button class="btn btn-success">Wróć do listy zgłoszeń</button></a>
        <a href="{{route('single.service.order.edit', $singleOrder->id)}}"><button class="btn btn-warning">Edytuj zgłoszenie</button></a>
        <a class="ms-5" href=""><button class="btn btn-danger ms-5">Anuluj zgłoszenie</button></a>


        <form method="POST" action="{{route('single.service.order.delete', $singleOrder->id)}}">
            @csrf
            {{method_field('DELETE')}} 
            <button class="btn btn-danger mt-5" onclick="return confirm('Are you sure?')">Usuń zgłoszenie</button>
        </form>



    </div>
    <!-- /BREADCRUMB -->
<div class="row layout-top-spacing">


        <div class="col-md-12">



<div class="row layout-top-spacing">

        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">

            <div class="widget-content widget-content-area br-8 p-5">
                <h4>Aktualne dane zlecenia nr: {{$singleOrder->id}}</h4>
                <h5 class="ms-5"  >Tytuł: {{$singleOrder->title}}</h5>
                <div class="p-5 d-flex justify-content-evenly">
                    
                        <div>
                        <h6> <strong>Prowadzący:</strong> Piotr Opęchowski</h6>
                        <br>
                        <h6> <strong>Status:</strong>  <span>{{$singleOrder->status}}</span></h6>
                        <br>
                        <h6><strong>Typ:</strong> rotacje</h6>
                        <br>
                        </div>
                        <div>
                        <h6><strong>Firma:</strong> Marex Opakowani</h6>
                        <br>
                        <h6><strong>Pracownik:</strong> konstruktor</h6>
                        <br>
                        </div>
                        <div>
                        <h6><strong>Data otrzymania:</strong> {{$singleOrder->date}}</h6>
                        <br>
                        <h6><strong>Termin wykonania:</strong> 23.03.2023</h6>
                        </div>
                
                </div>
            </div>

        </div>

        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">

<div class="widget-content widget-content-area br-8">

                    <div class="mt-container mx-auto">
                    <div class="timeline-line">

                    <div class="item-timeline">
                    <p class="t-time">10:00</p>
                    <div class="t-dot t-dot-primary">
                    </div>
                    <div class="t-text">
                    <p>Zgłoszenie zaktualizowane - zamknięte</p>
                    <p class="t-meta-time">25 min temu</p>
                    </div>
                    </div>

                    <div class="item-timeline">
                    <p class="t-time">12:45</p>
                    <div class="t-dot t-dot-success">
                    </div>
                    <div class="t-text">
                    <p>Email do klienta wysłany <a href="{{route('single.email')}}"> <button class="btn btn-success">Pokaż</button></a></p></p> 
                    <p class="t-meta-time">2 godziny temu</p>
                    </div>
                    </div>

                    <div class="item-timeline">
                    <p class="t-time">14:00</p>
                    <div class="t-dot t-dot-warning">
                    </div>
                    <div class="t-text">
                    <p>SYSTEM - Zmiana statusu zgłoszenia na Otwarte</p>
                    <p class="t-meta-time">4 godzin temu</p>
                    </div>
                    </div>

                    <div class="item-timeline">
                    <p class="t-time">16:00</p>
                    <div class="t-dot t-dot-info">
                    </div>
                    <div class="t-text">
                    <p>Wiadomość od <a href="#">Piotr Wiski</a><a href="{{route('single.email')}}"> <button class="btn btn-success">Pokaż</button></a></p></p>
                    <p class="t-meta-time">6 godzin temu</p>
                    </div>
                    </div>

                    <div class="item-timeline">
                    <p class="t-time">17:00</p>
                    <div class="t-dot t-dot-danger">
                    </div>
                    <div class="t-text">
                    <p>Wiadomość email od: <a href="#">Piotr Opęchowski</a> <a href="{{route('single.email')}}"> <button class="btn btn-success">Pokaż</button></a></p>
                    <p class="t-meta-time">9 godzin temu</p>
                    </div>
                    </div>

                    <div class="item-timeline">
                    <p class="t-time">16:00</p>
                    <div class="t-dot t-dot-dark">
                    </div>
                    <div class="t-text">
                    <p>Zgłoszenie przekazane do <a href="#"> Janet Jackson</a></p>
                    <p class="t-meta-time">8 godzin temu</p>
                    </div>
                    </div>

                    </div>                                    
                    </div>

            </div>
            
        </div>



        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">

            <div class="post-info">
                    
                    <hr>

                    {{-- <div class="post-tags mt-5">

                        <span class="badge badge-primary mb-2">Admin</span>
                        <span class="badge badge-primary mb-2">Themeforeset</span>
                        <span class="badge badge-primary mb-2">Dashboard</span>
                        <span class="badge badge-primary mb-2">Top 10</span>
                        
                    </div> --}}

                    {{-- <div class="post-dynamic-meta mt-5 mb-5">

                        <button class="btn btn-secondary me-4 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            <span class="btn-text-inner">1.1k</span>
                        </button>
                        
                        <div class="avatar--group mb-2">
                            <div class="avatar avatar-sm m-0">
                                <img alt="avatar" src="{{Vite::asset('resources/images/profile-16.jpeg')}}" class="rounded-circle">
                            </div>
                            <div class="avatar avatar-sm">
                                <img alt="avatar" src="{{Vite::asset('resources/images/delete-user-4.jpeg')}}" class="rounded-circle">
                            </div>
                            <div class="avatar avatar-sm">
                                <img alt="avatar" src="{{Vite::asset('resources/images/profile-5.jpeg')}}" class="rounded-circle">
                            </div>
                            <div class="avatar avatar-sm">
                                <span class="avatar-title rounded-circle">AG</span>
                            </div>
                        </div>
                    </div> --}}
                    
                    <hr>

                    <h2 class="mb-5">Comments <span class="comment-count">(4)</span></h2>

                    <div class="post-comments">

                        <div class="media mb-5 pb-5 primary-comment">
                            <div class="avatar me-4">
                                <img alt="avatar" src="{{Vite::asset('resources/images/profile-2.jpeg')}}" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading mb-1">Daisy Andrason</h5>
                                <div class="meta-info mb-0">14 April</div>
                                <p class="media-text mt-2 mb-0">Fusce condimentum cursus mauris et ornare. Mauris fermentum mi id sollicitudin viverra. Aenean dignissim sed ante eget dapibus. Sed dapibus nulla elementum, rutrum neque eu, gravida neque.</p>

                                <button class="btn btn-success btn-icon btn-reply btn-rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                </button>
                                
                                <div class="media mb-4 mt-4">
                                    <div class="avatar me-4">
                                        <img alt="avatar" src="{{Vite::asset('resources/images/profile-3.jpeg')}}" class="rounded-circle" />
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading mb-1">Xavier</h5>
                                        <div class="meta-info mb-0">15 April</div>
                                        <p class="media-text mt-2 mb-0">Fusce condimentum cursus mauris et ornare. Mauris fermentum mi id sollicitudin viverra. Aenean dignissim sed ante eget dapibus. Sed dapibus nulla elementum, rutrum neque eu, gravida neque.</p>
                                    </div>
                                </div>

                                <div class="media mt-4">
                                    <div class="avatar me-4">
                                        <img alt="avatar" src="{{Vite::asset('resources/images/profile-25.jpeg')}}" class="rounded-circle" />
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading mb-1">Mary McDonald</h5>
                                        <div class="meta-info mb-0">15 April</div>
                                        <p class="media-text mt-2 mb-0">Fusce condimentum cursus mauris et ornare. Mauris fermentum mi id sollicitudin viverra. Aenean dignissim sed ante eget dapibus. Sed dapibus nulla elementum, rutrum neque eu, gravida neque.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="media mb-5 pb-5 primary-comment">
                            <div class="avatar me-4">
                                <img alt="avatar" src="{{Vite::asset('resources/images/profile-12.jpeg')}}" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading mb-1">Kelly Young</h5>
                                <div class="meta-info mb-0">12 April</div>
                                <p class="media-text mt-2 mb-0">Fusce condimentum cursus mauris et ornare. Mauris fermentum mi id sollicitudin viverra. Aenean dignissim sed ante eget dapibus. Sed dapibus nulla elementum, rutrum neque eu, gravida neque.</p>

                                <button class="btn btn-success btn-icon btn-reply btn-rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                </button>

                                <div class="media mt-4">
                                    <div class="avatar me-4">
                                        <img alt="avatar" src="{{Vite::asset('resources/images/profile-21.jpeg')}}" class="rounded-circle" />
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading mb-1">Andy King</h5>
                                        <div class="meta-info mb-0">13 April</div>
                                        <p class="media-text mt-2 mb-0">Fusce condimentum cursus mauris et ornare. Mauris fermentum mi id sollicitudin viverra. Aenean dignissim sed ante eget dapibus. Sed dapibus nulla elementum, rutrum neque eu, gravida neque.</p>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="media mb-5 pb-5 primary-comment">
                            <div class="avatar me-4">
                                <img alt="avatar" src="{{Vite::asset('resources/images/profile-9.jpeg')}}" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <h5 class="media-heading mb-1">Alma Clarke</h5>
                                <div class="meta-info mb-0">10 April</div>
                                <p class="media-text mt-2 mb-0">Fusce condimentum cursus mauris et ornare. Mauris fermentum mi id sollicitudin viverra. Aenean dignissim sed ante eget dapibus. Sed dapibus nulla elementum, rutrum neque eu, gravida neque.</p>

                                <button class="btn btn-success btn-icon btn-reply btn-rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                </button>
                                
                            </div>
                        </div>

                        <div class="post-pagination">

                            <div class="pagination-no_spacing">

                                <ul class="pagination">
                                    <li><a href="javascript:void(0);" class="prev"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg></a></li>
                                    <li><a href="javascript:void(0);">1</a></li>
                                    <li><a href="javascript:void(0);" class="active">2</a></li>
                                    <li><a href="javascript:void(0);">3</a></li>
                                    <li><a href="javascript:void(0);" class="next"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></a></li>
                                </ul>

                            </div>
                            
                        </div>
                        

                    </div>
                    
                    <div class="post-form mt-5">

                        <div class="section add-comment">
                            <div class="info">
                                <h6>Dodaj swój <span class="text-success">komentarz</span> do tego zgłoszenia.</h6>
                                

                                <div class="row mt-4">

                                        <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Napisz komentarz</label>
                                            <textarea class="form-control" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="text-end mt-4">
                                    <button class="btn btn-primary me-3">Wyczyść</button>
                                    <button class="btn btn-success">Dodaj</button>
                                </div>
                            </div>
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
        <script src="{{asset('plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
        <script src="{{asset('plugins/glightbox/glightbox.min.js')}}"></script>
        <script src="{{asset('plugins/splide/splide.min.js')}}"></script>
        @vite(['resources/assets/js/apps/ecommerce-details.js'])

        <script src="{{asset('plugins/apex/apexcharts.min.js')}}"></script>
        {{-- <script src="{{asset('plugins/apex/custom-apexcharts.js')}}"></script> --}}
        @vite(['resources/assets/js/widgets/modules-widgets.js'])

    </x-slot>
    <!--  END CUSTOM SCRIPTS FILE  -->
</x-base-layout>