<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/cropped-HH-Global-favicon-3-32x32.webp') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('img/favicon.webp') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

    <title>
        Coca-Cola -
        @hasSection('title')
            @yield('title') |
        @endif
    </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"> --}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet"> --}}
    @livewireStyles
</head>

<body class="h-screen bg-[#f9f9f9]" style="margin-top:70px;">
    <div class="h-full flex flex-col justify-between">
        <div class="w-full bg-white">
            @include('layouts.components.navbar')
        </div>
        <div class="flex-grow w-full" >
            @yield('content')
        </div>
        @yield('scripts')
        <!-- Footer -->
        <footer id="footerPrincipal" class="bg-primary text-white py-10 px-8">
            <!-- Logo en la esquina superior izquierda -->
            <div class="flex justify-start md:justify-between items-start mb-8">
                <div>
                    <img src="{{asset('img/home/footerLogo.png')}}" alt="Logo" class="h-10">
                </div>
            </div>

            <hr class="border-white mb-8">

            <!-- Menú vertical y categorías, más juntas y responsivo -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Menú de enlaces -->
                <div class="flex flex-col space-y-2">
                    <h4 class="text-lg font-bold mb-4">Menú</h4>
                    <a href="#" class="hover:underline">Inicio</a>
                    <a href="#" class="hover:underline">Catálogo</a>
                    <a href="#" class="hover:underline">Importaciones</a>
                    <a href="#" class="hover:underline">Mis Compras</a>
                </div>

                <!-- Categorías -->
                <div class="flex flex-col space-y-2">
                    <h4 class="text-lg font-bold mb-4">Categorías</h4>
                    <a href="#" class="hover:underline">Bebibles</a>
                    <a href="#" class="hover:underline">Ropa</a>
                    <a href="#" class="hover:underline">Ecológicos</a>
                </div>
            </div>

            <!-- Copyright y redes sociales responsivos -->
            <div class="flex flex-col md:flex-row justify-between items-center">
                <!-- Sello de copyright en la esquina inferior izquierda -->
                <div class="text-sm mb-6 md:mb-0">
                    © 2024 The Coca‑Cola Company. Todos los derechos reservados.
                </div>

                <!-- Redes sociales y política de privacidad -->
                <div class="flex flex-col items-center space-y-4 md:space-y-0 md:flex-row md:space-x-6">
                    <!-- Logos de redes sociales -->
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-primary">
                            <img src="{{asset('img/home/fb.svg')}}" alt="Facebook" class="h-6 w-6">
                        </a>
                        <a href="#" class="hover:text-primary">
                            <img src="{{asset('img/home/insta.svg')}}" alt="Instagram" class="h-6 w-6">
                        </a>
                        <a href="#" class="hover:text-primary">
                            <img src="{{asset('img/home/twitter.svg')}}" alt="Twitter" class="h-6 w-6">
                        </a>
                        <a href="#" class="hover:text-primary">
                            <img src="{{asset('img/home/youtube.svg')}}" alt="Twitter" class="h-6 w-6">
                        </a>
                    </div>

                    <!-- Política de privacidad debajo de redes sociales en pantallas pequeñas -->
                    <a href="#" class="text-sm hover:underline md:mt-0">Política de privacidad</a>
                </div>
            </div>
        </footer>
        @role(['buyers-manager', 'buyer'])
            @livewire('soporte-component')
        @endrole
    </div>

    @livewireScripts
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>


    @if(Auth::user() != null && !Auth::user()->hasRole('invited'))
        <div class="max-w-7xl" style="z-index:50">
            <a id="whatsapp-link" href="https://api.whatsapp.com/send?phone=5530385592" class="fixed bottom-4 right-4 p-4 bg-green-500 text-white rounded-full shadow-lg"  style=" z-index:30; @media (max-width: 768px) { margin: 0 120px 0px 0; z-index:30; }">
                <svg width="40px" height="40px" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16 31C23.732 31 30 24.732 30 17C30 9.26801 23.732 3 16 3C8.26801 3 2 9.26801 2 17C2 19.5109 2.661 21.8674 3.81847 23.905L2 31L9.31486 29.3038C11.3014 30.3854 13.5789 31 16 31ZM16 28.8462C22.5425 28.8462 27.8462 23.5425 27.8462 17C27.8462 10.4576 22.5425 5.15385 16 5.15385C9.45755 5.15385 4.15385 10.4576 4.15385 17C4.15385 19.5261 4.9445 21.8675 6.29184 23.7902L5.23077 27.7692L9.27993 26.7569C11.1894 28.0746 13.5046 28.8462 16 28.8462Z" fill="#BFC8D0"/>
                    <path d="M28 16C28 22.6274 22.6274 28 16 28C13.4722 28 11.1269 27.2184 9.19266 25.8837L5.09091 26.9091L6.16576 22.8784C4.80092 20.9307 4 18.5589 4 16C4 9.37258 9.37258 4 16 4C22.6274 4 28 9.37258 28 16Z" fill="url(#paint0_linear_87_7264)"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16 30C23.732 30 30 23.732 30 16C30 8.26801 23.732 2 16 2C8.26801 2 2 8.26801 2 16C2 18.5109 2.661 20.8674 3.81847 22.905L2 30L9.31486 28.3038C11.3014 29.3854 13.5789 30 16 30ZM16 27.8462C22.5425 27.8462 27.8462 22.5425 27.8462 16C27.8462 9.45755 22.5425 4.15385 16 4.15385C9.45755 4.15385 4.15385 9.45755 4.15385 16C4.15385 18.5261 4.9445 20.8675 6.29184 22.7902L5.23077 26.7692L9.27993 25.7569C11.1894 27.0746 13.5046 27.8462 16 27.8462Z" fill="white"/>
                    <path d="M12.5 9.49989C12.1672 8.83131 11.6565 8.8905 11.1407 8.8905C10.2188 8.8905 8.78125 9.99478 8.78125 12.05C8.78125 13.7343 9.52345 15.578 12.0244 18.3361C14.438 20.9979 17.6094 22.3748 20.2422 22.3279C22.875 22.2811 23.4167 20.0154 23.4167 19.2503C23.4167 18.9112 23.2062 18.742 23.0613 18.696C22.1641 18.2654 20.5093 17.4631 20.1328 17.3124C19.7563 17.1617 19.5597 17.3656 19.4375 17.4765C19.0961 17.8018 18.4193 18.7608 18.1875 18.9765C17.9558 19.1922 17.6103 19.083 17.4665 19.0015C16.9374 18.7892 15.5029 18.1511 14.3595 17.0426C12.9453 15.6718 12.8623 15.2001 12.5959 14.7803C12.3828 14.4444 12.5392 14.2384 12.6172 14.1483C12.9219 13.7968 13.3426 13.254 13.5313 12.9843C13.7199 12.7145 13.5702 12.305 13.4803 12.05C13.0938 10.953 12.7663 10.0347 12.5 9.49989Z" fill="white"/>
                    <defs>
                    <linearGradient id="paint0_linear_87_7264" x1="26.5" y1="7" x2="4" y2="28" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#5BD066"/>
                    <stop offset="1" stop-color="#27B43E"/>
                    </linearGradient>
                    </defs>
                </svg>
            </a>
        </div>
    @endif

</body>

</html>
