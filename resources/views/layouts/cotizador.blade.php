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
        HH GLOBAL - 
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

<body class="h-screen" style="margin-top:70px;">
    <div class="h-full flex flex-col justify-between">  
        <div class="w-full bg-white">
            @include('layouts.components.navbar')
        </div>
        <div class="flex-grow w-full" >
            @yield('content')
        </div>
        @yield('scripts')
        <footer class="py-5 w-full bg-stone-900 text-white bottom-0 left-0 z-30 footer">
            <div class="w-full flex flex-col sm:flex-row justify-between items-center text-primary mt-4">
          
                <div class="mb-4 sm:mb-0 pl-20">
                    <img src="{{asset('img/hh-logo.png')}}" alt="logo" style="width: 180px;" class="mb-10 mt-6">

                    <div class="flex">
                    @if(!Auth::user()->hasRole('invited'))
                        <a href="#" class="mr-6">
                            <svg fill="#FFFFFF" width="30px" height="30px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2.03998C6.5 2.03998 2 6.52998 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.84998C10.44 7.33998 11.93 5.95998 14.22 5.95998C15.31 5.95998 16.45 6.14998 16.45 6.14998V8.61998H15.19C13.95 8.61998 13.56 9.38998 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96C15.9164 21.5878 18.0622 20.3855 19.6099 18.57C21.1576 16.7546 22.0054 14.4456 22 12.06C22 6.52998 17.5 2.03998 12 2.03998Z"/>
                            </svg>
                        </a>
                        
                        <a href="#" class="mr-6">
                            <svg width="30px" height="30px" viewBox="0 0 41 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M31.5933 0.411377H37.7347L24.3176 15.2754L40.1018 35.5019H27.7429L18.0629 23.2346L6.98689 35.5019H0.841784L15.1927 19.6032L0.0509033 0.411377H12.7236L21.4734 11.6242L31.5933 0.411377ZM29.4379 31.9389H32.8409L10.8745 3.78727H7.22267L29.4379 31.9389Z" fill="white"/>
                            </svg>
                                
                        </a>

                        <a href="#" class="mr-6">
                            <svg width="30px" height="30px" viewBox="0 0 41 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.139 3.81317C25.4927 3.81317 26.1267 3.83798 28.2321 3.93724C30.1889 4.02823 31.2455 4.37563 31.95 4.66513C32.8814 5.04562 33.5545 5.50883 34.2511 6.24499C34.9555 6.98943 35.386 7.69251 35.7461 8.67682C36.02 9.42125 36.3488 10.5462 36.4349 12.6058C36.5288 14.8391 36.5523 15.5091 36.5523 21.1585C36.5523 26.8162 36.5288 27.4862 36.4349 29.7113C36.3488 31.7792 36.02 32.8958 35.7461 33.6402C35.386 34.6246 34.9477 35.3359 34.2511 36.0721C33.5467 36.8165 32.8814 37.2714 31.95 37.6519C31.2455 37.9414 30.1811 38.2888 28.2321 38.3798C26.1188 38.4791 25.4848 38.5039 20.139 38.5039C14.7853 38.5039 14.1513 38.4791 12.0458 38.3798C10.0891 38.2888 9.03244 37.9414 8.32801 37.6519C7.39659 37.2714 6.72347 36.8082 6.02686 36.0721C5.32243 35.3276 4.89195 34.6246 4.5319 33.6402C4.25796 32.8958 3.92922 31.7709 3.84312 29.7113C3.7492 27.478 3.72572 26.808 3.72572 21.1585C3.72572 15.5008 3.7492 14.8308 3.84312 12.6058C3.92922 10.5379 4.25796 9.42125 4.5319 8.67682C4.89195 7.69251 5.33026 6.98116 6.02686 6.24499C6.7313 5.50056 7.39659 5.04562 8.32801 4.66513C9.03244 4.37563 10.0969 4.02823 12.0458 3.93724C14.1513 3.83798 14.7853 3.81317 20.139 3.81317ZM20.139 0C14.6992 0 14.0183 0.0248145 11.8815 0.124073C9.75253 0.223331 8.28887 0.587277 7.0209 1.10838C5.69813 1.6543 4.57887 2.37392 3.46743 3.55675C2.34816 4.73131 1.66721 5.91413 1.15063 7.30375C0.657525 8.652 0.313136 10.1905 0.219212 12.4404C0.125288 14.7067 0.101807 15.4264 0.101807 21.1751C0.101807 26.9238 0.125288 27.6434 0.219212 29.9015C0.313136 32.1514 0.657525 33.6981 1.15063 35.0381C1.66721 36.436 2.34816 37.6188 3.46743 38.7934C4.57887 39.9679 5.69813 40.6958 7.01307 41.2335C8.28887 41.7546 9.7447 42.1185 11.8737 42.2178C14.0104 42.3171 14.6914 42.3419 20.1312 42.3419C25.5709 42.3419 26.2519 42.3171 28.3887 42.2178C30.5176 42.1185 31.9813 41.7546 33.2493 41.2335C34.5642 40.6958 35.6835 39.9679 36.7949 38.7934C37.9063 37.6188 38.5951 36.436 39.1039 35.0464C39.597 33.6981 39.9414 32.1596 40.0353 29.9098C40.1292 27.6517 40.1527 26.932 40.1527 21.1833C40.1527 15.4346 40.1292 14.715 40.0353 12.4569C39.9414 10.207 39.597 8.66027 39.1039 7.32029C38.6108 5.91413 37.9298 4.73131 36.8106 3.55675C35.6991 2.3822 34.5799 1.6543 33.2649 1.11665C31.9891 0.595549 30.5333 0.231602 28.4043 0.132344C26.2597 0.0248145 25.5788 0 20.139 0Z" fill="white"/>
                                <path d="M20.1389 10.2981C14.4564 10.2981 9.84631 15.17 9.84631 21.1751C9.84631 27.1803 14.4564 32.0522 20.1389 32.0522C25.8213 32.0522 30.4314 27.1803 30.4314 21.1751C30.4314 15.17 25.8213 10.2981 20.1389 10.2981ZM20.1389 28.2307C16.4523 28.2307 13.4624 25.071 13.4624 21.1751C13.4624 17.2793 16.4523 14.1195 20.1389 14.1195C23.8254 14.1195 26.8153 17.2793 26.8153 21.1751C26.8153 25.071 23.8254 28.2307 20.1389 28.2307Z" fill="white"/>
                                <path d="M33.2416 9.86773C33.2416 11.2739 32.1615 12.4071 30.8387 12.4071C29.5081 12.4071 28.4358 11.2656 28.4358 9.86773C28.4358 8.46157 29.5159 7.32837 30.8387 7.32837C32.1615 7.32837 33.2416 8.46984 33.2416 9.86773Z" fill="white"/>
                            </svg>
                        </a>

                        <a href="#" class="mr-6">
                            <svg width="30px" height="30px" viewBox="0 0 41 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M39.8047 6.48532C39.8047 6.48532 39.4135 3.56547 38.2089 2.28339C36.6835 0.595998 34.9782 0.587726 34.196 0.488468C28.5951 0.0583494 20.186 0.0583496 20.186 0.0583496H20.1703C20.1703 0.0583496 11.7612 0.0583494 6.16034 0.488468C5.3781 0.587726 3.67281 0.595998 2.14743 2.28339C0.942776 3.56547 0.559477 6.48532 0.559477 6.48532C0.559477 6.48532 0.15271 9.91799 0.15271 13.3424V16.5517C0.15271 19.9762 0.551654 23.4088 0.551654 23.4088C0.551654 23.4088 0.942776 26.3287 2.13961 27.6108C3.66498 29.2982 5.66753 29.2403 6.55929 29.4222C9.76649 29.7448 20.1782 29.8441 20.1782 29.8441C20.1782 29.8441 28.5951 29.8275 34.196 29.4057C34.9782 29.3064 36.6835 29.2982 38.2089 27.6108C39.4135 26.3287 39.8047 23.4088 39.8047 23.4088C39.8047 23.4088 40.2036 19.9844 40.2036 16.5517V13.3424C40.2036 9.91799 39.8047 6.48532 39.8047 6.48532ZM16.0401 20.4476V8.54492L26.8585 14.517L16.0401 20.4476Z" fill="white"/>
                            </svg>    
                        </a>
                    @endif
                        

                    </div>
                    <p class="ml-4 mr-4 text-base text-white mt-10 mb-10 pl-2">Copyright © 2024</p>
                </div>
    
                <div class="flex flex-col text-center items-center -mt-7">
                    <img src="{{asset('img/servicio1.png')}}" alt="servicio" style="width: 60px;" class="mb-6">
                    <p class="ml-4 mr-4 text-sm text-white">SERVICIO AL CLIENTE 24/7</p>
                    <p class="ml-4 mr-4 text-xs text-gray-300 mt-2">Atención al cliente amigable 24 horas al día, 7 días a la semana</p>
                </div>
    
                <div class="flex flex-col text-center items-center -mt-7">
                    <img src="{{asset('img/servicio2.png')}}" alt="garantia" style="width: 60px;" class="mb-6">
                    <p class="ml-4 mr-4 text-sm text-white">GARANTÍA DE CALIDAD </p>
                    <p class="ml-4 mr-4 text-xs text-gray-300 mt-2">Garantizamos la calidad en productos y servicio</p>
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

    
    @if(!Auth::user()->hasRole('invited'))
        <div class="max-w-7xl" style="z-index:50">
            <a id="whatsapp-link" href="https://api.whatsapp.com/send?phone=5568096555" class="fixed bottom-4 right-4 p-4 bg-green-500 text-white rounded-full shadow-lg"  style=" z-index:30; @media (max-width: 768px) { margin: 0 120px 0px 0; z-index:30; }">
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
