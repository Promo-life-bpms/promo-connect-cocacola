

<div class="fixed top-0 left-0 right-0 z-50 bg-black"> 
    <div class="fixed top-0 left-0 right-0 z-50 bg-black" style="z-index: 20;">

    <!-- Menú para dispositivos de escritorio  -->
    <div class="hidden md:flex md:justify-between md:items-center md:h-20 text-white px-12">

        <a href="{{ route('index') }}" class="flex">
            <img src="{{asset('img/hh-logo.png')}}"
                style="object-fit: cover; width:100px;"
                alt="logo" class="p-2 ">
            <div class="text-black text-sm bg-stone-200 " style="margin: 0 0 0 4px; padding:0 4px 0 4px; height:20px; margin-top:8px;">México</div>
        </a>
       
        <div class="flex items-center space-x-4">

            @if (auth()->user())
                <a href="/profile" class="flex">
                    <svg class="mt-3" width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 21C5 17.134 8.13401 14 12 14C15.866 14 19 17.134 19 21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#FF5900" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <p class="ml-2 mt-4 text-sm text-orange-500 font-semibold">{{ (explode(' ', auth()->user()->name)[0]) }}</p>
                </a>   
            @endif
                
            @role('buyers-manager')
                <a href="{{ route('administrador') }}" class="text-sm text-orange-500 font-semibold mt-4 px-4">Administrador</a>
            @endrole

            @role('admin')
                <a href="{{ route('admin.dashboard') }}" class="text-lg text-orange-500 font-semibold mt-4 px-4">Administrador</a>
            @endrole

            @role(['buyers-manager', 'buyer'])
                <div class="mb-7 md:mt-7 md:mb-0 mx-1">
                    <p class="text-white hover:text-hh-green text-sm mx-2"><a href="{{ route('catalogo') }}">Catálogo</a></p>
                </div>

                <div class="mb-7 md:mt-7 md:mb-0 mx-2">
                    <p class="text-white hover:text-hh-green text-sm mx-2"><a href="{{ route('importation') }}">Importación</a></p>
                </div>

                <div class="mb-7 md:mt-7 md:mb-0 mx-1">
                    <p class="text-white hover:text-hh-green text-sm mx-2"><a href="{{ route('compras') }}">Mis compras</a></p>
                </div>
            
                <div class="mb-7 md:mt-7 md:mb-0 mx-2">
                    <p class="text-white hover:text-hh-green text-sm mx-2"><a href="{{ route('misCotizaciones') }}">Mis cotizaciones</a></p>
                </div>
                <div class="mb-7 md:mt-7 md:mb-0 mx-2">
                    <p class="text-white hover:text-hh-green text-sm mx-2"><a href="{{ route('special') }}">Especiales</a></p>
                </div>
            @endrole

            @role('seller')
                <a href="{{ route('compras') }}" class="text-sm text-orange-500 font-semibold mt-4 px-4">Compras</a>
                <a href="{{ route('seller.content') }}" class="text-sm text-orange-500 font-semibold mt-4 px-4">Banners</a>
                <a href="{{ route('seller.compradores') }}" class="text-sm text-orange-500 font-semibold mt-4 px-4">Compradores</a>
                <a href="{{ route('seller.pedidos') }}" class="text-sm text-orange-500 font-semibold mt-4 px-4">Compras</a>
                {{-- <a href="{{ route('seller.muestras') }}" class="text-sm text-orange-500 font-semibold mt-4 px-4">Muestras</a> --}}
            @endrole

            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="text-sm text-orange-500 font-semibold mt-4">Cerrar Sesion</button>

            @role(['buyers-manager', 'buyer'])
            
                <a class="text-primary hover:text-primary mt-4" href="{{ route('catalogo') }}">
                    <div class="-mt-1">
                        <svg width="25px" height="25px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <style>.cls-1{fill:none;stroke:#020202;stroke-miterlimit:10;stroke-width:1.91px;}</style>
                            </defs> 
                            <g id="handbag">
                                <path class="cls-1" d="M3.41,7.23H20.59a0,0,0,0,1,0,0v12a3.23,3.23,0,0,1-3.23,3.23H6.64a3.23,3.23,0,0,1-3.23-3.23v-12A0,0,0,0,1,3.41,7.23Z"/>
                                <path class="cls-1" d="M8.18,10.09V5.32A3.82,3.82,0,0,1,12,1.5h0a3.82,3.82,0,0,1,3.82,3.82v4.77"/>
                            </g>
                        </svg>
                    </div>
                </a>

                <div class="mt-1" style="width: 2rem">
                    @livewire('count-cart-quote')
                </div>

            @endrole
        </div>
    </div>

    <!-- Menú hamburguesa para dispositivos móviles-->
    <div class="md:hidden flex justify-between items-center h-16 bg-white text-white px-4 shadow-md">
        <a href="{{ route('index') }}" class="flex items-center">
            <img src="{{ asset('img/Astore.png') }}" alt="Logo" class="p-2" style="width: 200px;">
        </a>
        <button id="menu-toggle" class="px-4 py-2 focus:outline-none">
            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 18L20 18" stroke="#FF5900" stroke-width="2" stroke-linecap="round"/>
                <path d="M4 12L20 12" stroke="#FF5900" stroke-width="2" stroke-linecap="round"/>
                <path d="M4 6L20 6" stroke="#FF5900" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
    </div>

    <!-- Menú desplegable para dispositivos móviles -->
    <div id="mobile-menu" class="hidden md:hidden flex flex-col justify-end items-start bg-white text-black" style="z-index: 10">
        
        <div class="flex flex-col items-start">
            <a href="/" class="text-sm text-orange-500 font-semibold mt-4 px-4">Inicio</a>

            @if (auth()->user())
                <a href="/profile" class="flex" style="margin-left: 10px;">
                    <p class="ml-2 mt-4 text-sm text-orange-500 font-semibold">{{ (explode(' ', auth()->user()->name)[0]) }}</p>
                </a>   
            @endif
                
            @role('buyers-manager')
                <a href="{{ route('administrador') }}" class="text-sm text-orange-500 font-semibold mt-4 px-4">Administrador</a>
            @endrole

            @role('admin')
                <a href="{{ route('admin.dashboard') }}" class="text-lg text-orange-500 font-semibold mt-4 px-4">Administrador</a>
            @endrole

            @role(['buyers-manager', 'buyer'])
                <div class="mb-7 md:mt-7 md:mb-0 mx-1">
                    <p class="text-white hover:text-hh-green text-sm mx-2"><a href="{{ route('catalogo') }}">Catálogo</a></p>
                </div>

                <div class="mb-7 md:mt-7 md:mb-0 mx-2">
                    <p class="text-white hover:text-hh-green text-sm mx-2"><a href="{{ route('importation') }}">Importación</a></p>
                </div>

                <div class="mb-7 md:mt-7 md:mb-0 mx-1">
                    <p class="text-white hover:text-hh-green text-sm mx-2"><a href="{{ route('compras') }}">Mis compras</a></p>
                </div>
            
                <div class="mb-7 md:mt-7 md:mb-0 mx-2">
                    <p class="text-white hover:text-hh-green text-sm mx-2"><a href="{{ route('misCotizaciones') }}">Mis cotizaciones</a></p>
                </div>
                <div class="mb-7 md:mt-7 md:mb-0 mx-2">
                    <p class="text-white hover:text-hh-green text-sm mx-2"><a href="{{ route('special') }}">Especiales</a></p>
                </div>
            @endrole
 
            @role('seller')
                <a href="{{ route('seller.content') }}" class="text-sm text-orange-500 font-semibold mt-4 px-4">Banners</a>
                <a href="{{ route('seller.compradores') }}" class="text-sm text-orange-500 font-semibold mt-4 px-4">Compradores</a>
                <a href="{{ route('seller.pedidos') }}" class="text-sm text-orange-500 font-semibold mt-4 px-4">Compras</a>
                {{-- <a href="{{ route('seller.muestras') }}" class="text-sm text-orange-500 font-semibold mt-4 px-4">Muestras</a> --}}
            @endrole


            <a href="/catalogo" class="text-sm text-orange-500 font-semibold mt-4 px-4"> Catálogo</a>

            <a href="/carrito" class="text-sm text-orange-500 font-semibold mt-4 px-4"> Carrito</a>


            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="text-sm text-orange-500 font-semibold mt-4 ml-4">Cerrar Sesion</button>

        </div>
    </div>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
    
    </div>
    <div id="popup-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full bg-white rounded-lg shadow-lg">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-hide="popup-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>

                        </svg>
                        <span class="sr-only">Cerrar</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Esta seguro de que desea
                            salir del sitio?</h3>
                        <a class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            Si, estoy seguro</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                        <button data-modal-hide="popup-modal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                            cancelar</button>
                    </div>
                </div>
            </div>
        </div>

</div>