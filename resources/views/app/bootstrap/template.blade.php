<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ url('assets/img/favicon.ico') }}">
        <!-- directiva -->
        <title>
            @yield('title', 'Barber Shop')
        </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ url('assets/css/styles.css') }}?v={{ time() }}">
        @yield('styles')
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">@yield('navbar', 'Travel Agency App')</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-4">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('about') }}">About</a>
                        </li>
                        @auth
                            @if(Auth::user()->rol == 'admin' || Auth::user()->rol == 'advanced')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('vacacion.create') }}">Add vacation</a>
                            </li>
                            @endif
                        @endauth
                        @if(Auth::user() != null && Auth::user()->rol == 'admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Usuarios
                            </a>
                            <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('user.index') }}">Listado</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('user.create') }}">Crear usuario</a></li>
                            </ul>
                        </li>
                        @endif
                        @if(Auth::user() != null && (Auth::user()->rol == 'admin' || Auth::user()->rol == 'advanced'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Vacaciones
                            </a>
                            <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('vacacion.index') }}">Vacaciones</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('vacacion.create') }}">Create</a></li>
                            </ul>
                        </li>
                        @endif

                    </ul>
                    
                    <!-- New Pill Search Bar -->
                    <form class="d-flex position-relative me-4" role="search" method="get" action="{{ route('main') }}">
                        @foreach(request()->except(['page', 'q']) as $item => $value)
                            <input type="hidden" name="{{ $item }}" value="{{ $value }}" >
                        @endforeach
                        <div class="input-group search-pill-group">
                             <input name="q" value="{{ $q ?? '' }}" class="form-control search-pill-input" type="search" placeholder="Search destinations..." aria-label="Search">
                             <button class="btn btn-search-pill" type="submit">
                                <i class="fas fa-search"></i>
                             </button>
                        </div>
                    </form>

                    <ul class="navbar-nav gap-3">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link fw-bold" href="{{ route('login') }}">Login</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle fw-bold" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                                    <li><a class="dropdown-item" href="{{ route('home') }}">Dashboard</a></li>
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                                <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container my-5">

            <!-- mostrar mensajes de éxito -->
            @if(session('mensajeTexto'))
                <div class="alert alert-success">
                    {{ session('mensajeTexto') }}
                </div>
            @endif

            <!-- mostrar mensajes de error -->
            @error('mensajeTexto')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            @yield('modalcontent')

            @yield('content')

        </div>
        
        <footer class="footer-mega">
            <div class="container footer-top">
                <div class="row w-100">
                    <div class="col-lg-5 footer-tagline">
                        <h2>Relax. <br> We got you.</h2>
                        <p class="text-white-50 mb-4">
                            Premium travel experiences curated for the modern explorer. <br> 
                            San Diego — California <br>
                            Paris — France
                        </p>
                        <a href="#" class="btn-pill-outline">Start Your Journey</a>
                    </div>
                    
                    <div class="col-lg-6 offset-lg-1 d-flex justify-content-between mt-5 mt-lg-0 footer-links-group">
                        <div class="footer-col">
                            <h5>Explore</h5>
                            <ul>
                                <li><a href="{{ route('main') }}">Home</a></li>
                                <li><a href="#">Destinations</a></li>
                                <li><a href="#">Packages</a></li>
                                <li><a href="{{ route('about') }}">Story</a></li>
                            </ul>
                        </div>
                        
                        <div class="footer-col">
                            <h5>Support</h5>
                            <ul>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">Privacy</a></li>
                                <li><a href="#">Legal</a></li>
                            </ul>
                        </div>

                        <div class="footer-col">
                            <h5>Social</h5>
                            <ul>
                                <li><a href="#">Instagram ↗</a></li>
                                <li><a href="#">Twitter ↗</a></li>
                                <li><a href="#">LinkedIn ↗</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="footer-big-text">
                TRAVEL
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"></script>
        <script src="{{ url('assets/js/main.js') }}"></script>
        @yield('scritps')
    </body>
</html>