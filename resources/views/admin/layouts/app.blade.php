<!doctype html>
<html data-bs-theme="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('styles')
    {{-- Setup Darkmode if necessary --}}
    <script>localStorage.getItem("darkmode") ? document.documentElement.setAttribute('data-bs-theme', 'dark') : document.documentElement.setAttribute('data-bs-theme', 'light');</script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/home') }}">
                    <img src="{{ Vite::asset('resources/images/logo.webp') }}" class="img-fluid" width="45"
                        alt="Logo">
                    <span class="h5 ms-3">Supde<span class="text-primary">Cours</span></span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->firstname }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                @if(Auth::user()->role->rights_lvl > 1)
                                    <a class="dropdown-item" href="{{ route('chapters.index') }}">
                                        <span class="me-2">📚</span>
                                        Tous les cours
                                    </a>
                                    <a class="dropdown-item" href="{{ route('days.index') }}">
                                        <span class="me-2">🌞</span>
                                        Toutes les journées
                                    </a>
                                @endif

                                @if(Auth::user()->role->rights_lvl > 2)
                                <hr>
                                    <a class="dropdown-item" href="{{ route('users.index') }}">
                                        <span class="me-2">🖲️</span>
                                        Gestion des utilisateurs
                                    </a>
                                    <a class="dropdown-item" href="/log-viewer">
                                        <span class="me-2">📜</span>
                                        Logs
                                    </a>
                                    <hr>
                                @endif
                                

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <span class="me-2">👋</span>

                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>



                            </div>
                        </li>
                    </ul>
                    <div class="ms-2">
                        @include('components.switch')
                    </div>
                </div>

            </div>
        </nav>

        <main class="py-4 bg-body-secondary">
            @yield('content')
        </main>
    </div>
    @stack('scripts')

    @if (session('success'))
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                Swal.fire(
                    '{{ session('success') }}',
                    '',
                    'success'
                )
            });
        </script>
    @endif
    @if (session('errors'))
        <script>
            window.addEventListener('DOMContentLoaded', () => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'error',
                    title: '{{ session('errors')->first() }}',
                });
            });
        </script>
    @endif

</body>

</html>
