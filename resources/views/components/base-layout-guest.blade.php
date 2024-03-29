{{--
/**
*
* Created a new component <x-base-layout/>.
* 
*/
--}}

@php
$isBoxed = layoutConfig()['boxed'];
$isAltMenu = layoutConfig()['alt-menu'];
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ $pageTitle }}</title>
    <link rel="icon" type="image/x-icon" href="{{Vite::asset('resources/images/favicon.ico')}}" />
    @vite(['resources/scss/layouts/vertical-light-menu/light/loader.scss'])

    @if (Request::is('modern-light-menu/*'))
    @vite(['resources/layouts/vertical-light-menu/loader.js'])
    @elseif (Request::is('modern-light-menu'))
    @vite(['resources/layouts/vertical-light-menu/loader.js'])
    @elseif ((Request::is('modern-dark-menu/*')))
    @vite(['resources/layouts/vertical-dark-menu/loader.js'])
    @elseif ((Request::is('collapsible-menu/*')))
    @vite(['resources/layouts/collapsible-menu/loader.js'])
    @endif

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/bootstrap.min.css')}}">
    @vite(['resources/scss/light/assets/main.scss', 'resources/scss/dark/assets/main.scss'])

    @if (
    !Request::routeIs('404') &&
    !Request::routeIs('maintenance') &&
    !Request::routeIs('signin') &&
    !Request::routeIs('signup') &&
    !Request::routeIs('lockscreen') &&
    !Request::routeIs('password-reset') &&
    !Request::routeIs('2Step') &&
    // Real Logins
    !Request::routeIs('login')
    )
    @if ($scrollspy == 1) @vite(['resources/scss/light/assets/scrollspyNav.scss', 'resources/scss/dark/assets/scrollspyNav.scss']) @endif
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/waves/waves.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/highlight/styles/monokai-sublime.css')}}">
    @vite([
    'resources/scss/light/plugins/perfect-scrollbar/perfect-scrollbar.scss',
    'resources/scss/layouts/vertical-light-menu/light/structure.scss',
    'resources/scss/layouts/vertical-light-menu/dark/structure.scss',
    ])

    @endif

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    @vite(['resources/css/custom.css'])
    {{$headerFiles}}
    <!-- END GLOBAL MANDATORY STYLES -->
</head>

<body>

    <!-- BEGIN LOADER -->
    {{-- <x-layout-loader /> --}}
    <!--  END LOADER -->

    {{--

    /*
    *
    *   Check if the routes are not single pages ( which does not contains sidebar or topbar  ) such as :-
    *   - 404
    *   - maintenance
    *   - authentication
    *
    */
    --}}

    @if (
    !Request::routeIs('404') &&
    !Request::routeIs('maintenance') &&
    !Request::routeIs('signin') &&
    !Request::routeIs('signup') &&
    !Request::routeIs('lockscreen') &&
    !Request::routeIs('password-reset') &&
    !Request::routeIs('2Step') &&
    // Real Logins
    !Request::routeIs('login')
    )

    <!--  BEGIN CONTENT AREA  -->
    <div>

        {{ $slot }}

    </div>
    <!--  END CONTENT AREA  -->



    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="{{asset('plugins/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('plugins/mousetrap/mousetrap.min.js')}}"></script>
    <script src="{{asset('plugins/waves/waves.min.js')}}"></script>
    <script src="{{asset('plugins/highlight/highlight.pack.js')}}"></script>
    @if ($scrollspy == 1) @vite(['resources/assets/js/scrollspyNav.js']) @endif

    @if (Request::is('modern-light-menu/*'))
    @vite(['resources/layouts/vertical-light-menu/app.js'])
    @elseif ((Request::is('modern-dark-menu/*')))
    @vite(['resources/layouts/vertical-dark-menu/app.js'])
    @elseif ((Request::is('collapsible-menu/*')))
    @vite(['resources/layouts/collapsible-menu/app.js'])
    @endif
    <!-- END GLOBAL MANDATORY STYLES -->

    @endif

    {{$footerFiles}}
    
</body>

</html>