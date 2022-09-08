<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- CDN Axios --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"
        integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        

</head>

<body>
    <section id="dashboard-style">
        <nav class="navbar navbar-expand-md flex-nowrap p-0">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0 nav-title" href="#"><i class="fa-brands fa-airbnb"></i>BoolBnB</a>
            <ul class="navbar-nav px-3 ml-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link nav-logout" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar py-4">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            {{-- <li class="nav-item">
                            <a class="nav-link active" href="{{ route('admin.home') }}">
                                <i class="fa-solid fa-house"></i>
                                Dashboard
                            </a>
                        </li> --}}
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.accomodations.index') }}">
                                    <i class="fa-solid fa-house"></i>
                                    Your Accomodations
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.accomodations.create') }}">
                                    <i class="fa-solid fa-square-plus"></i>
                                    Add Accomodation
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link active" href="">
                                    <i class="fa-solid fa-message"></i>
                                    Send a message
                                </a>
                            </li> --}}

                        </ul>

                    </div>
                </nav>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </section>
</body>

</html>
