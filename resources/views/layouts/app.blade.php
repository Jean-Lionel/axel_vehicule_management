<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />

    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="{{ asset('side/style.css') }}">
    <link rel="stylesheet" href="{{ asset('side/carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('side/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('side/v06_css_style.css') }}">
    <title>@yield('header_title')</title>
</head>

<body>
    <aside class="sidebar">
        <div class="toggle">
            <a href="#" class="burger js-menu-toggle" data-toggle="collapse" data-target="#main-navbar">
                <span></span>
            </a>
        </div>
        <div class="side-inner">
            <div class="logo-wrap">
                <div class="logo">
                    <span>C</span>
                </div>
                <span class="logo-text">{{ auth()->user()?->name }}</span>
            </div>
            <div class="search-form">
                <form action="#">
                    <span class="wrap-icon">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Search...">
                </form>
            </div>
            <div class="nav-menu">
                <ul>
                    <li @if(strpos(request()->route()->uri,"vehicule")) ? class='active' : '' @endif>
                        <a href="{{ route('vehicule.index') }}" class="d-flex align-items-center"><i class="bi bi-stoplights"></i>&nbsp;
                            <span class="menu-text">Vehicule</span></a>
                    </li>
                    <li @if(strpos(request()->route()->uri,"entretien")) ? class='active' : '' @endif>
                        <a href="{{ route('entretien.index') }}" class="d-flex align-items-center"><i class="bi bi-sliders"></i>&nbsp;<span class="menu-text">Entretien</span></a>
                    </li>
                    <li @if(strpos(request()->route()->uri,"depense")) ? class='active' : '' @endif>
                        <a href="{{ route('depense.index') }}" class="d-flex align-items-center"><i class="bi bi-cash-stack"></i>&nbsp;<span class="menu-text">Depenses</span></a></li>

                    <li @if(strpos(request()->route()->uri,"carburant")) ? class='active' : '' @endif>
                        <a href="{{ route('carburant.index') }}" class="d-flex align-items-center"><i class="bi bi-wrench"></i>&nbsp;<span class="menu-text">Carburant</span></a></li>
                        
                    <li @if(strpos(request()->route()->uri,"maintenance")) ? class='active' : '' @endif>
                        <a href="{{ route('maintenance.index') }}" class="d-flex align-items-center"><i class="bi bi-reply-all-fill"></i>&nbsp;<span
                                class="menu-text">Maintenance</span></a></li>
                    {{-- <li><a href="#" class="d-flex align-items-center"><span class="wrap-icon icon-cog mr-3"></span><span class="menu-text">Settings</span></a></li> --}}

                    <li><a href="#" class="d-flex align-items-center" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-left"></i>&nbsp;<span class="menu-text">Logout</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    </li>
                </ul>
            </div>
        </div>
    </aside>
    <main>
        <div class="site-section">
            <div class="container">
                <div class="row justify-content-center">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>


    <script src="{{ asset('side/v06_js_jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('side/v06_js_popper.min.js') }}"></script>
    <script src="{{ asset('side/v06_js_bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('side/v06_js_main.js') }}"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854"
        integrity="sha512-bjgnUKX4azu3dLTVtie9u6TKqgx29RBwfj3QXYt5EKfWM/9hPSAI/4qcV5NACjwAo8UtTeWefx6Zq5PHcMm7Tg=="
        data-cf-beacon='{"rayId":"7f2c62e429544ec9","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2023.7.0","si":100}'
        crossorigin="anonymous"></script>
        @stack('script_loader')

</html>
