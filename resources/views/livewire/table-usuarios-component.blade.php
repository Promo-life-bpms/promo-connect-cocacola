<div>
    <div class="bg-white mx-auto h-auto w-full grid md:grid-cols-2 p-3 gap-y-1 px-20">

        <div class="font-semibold text-slate-700 py-8 flex items-center space-x-2">
            <a class="text-secondary" href="/">Inicio</a>
            <p class="text-secondary"> / </p>
            <a class="text-secondary" href="#">Compradores</a>
        </div>

        <div class="flex mt-6">

            <div class="w-1/2">

            </div>
            <div class="flex">
                <form action="{{ route('download.stadistics')}}" method="POST">
                    @csrf
                    <button type="submit" class="text-black bg-primary text-black hover:bg-black hover:text-white focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none flex">
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                            <path d="M3 15C3 17.8284 3 19.2426 3.87868 20.1213C4.75736 21 6.17157 21 9 21H15C17.8284 21 19.2426 21 20.1213 20.1213C21 19.2426 21 17.8284 21 15" stroke="#a8a8a8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 3V16M12 16L16 11.625M12 16L8 11.625" stroke="#a8a8a8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Registros de usuarios
                    </button>
                </form>
            </div>


        </div>
        <br>

        @if (@Auth::user()->hasRole('admin'))
        <div class="grid grid-cols-2 gap-x-1 md:col-start-1 mt-1 col-end-1 md:mx-5 md:gap-x-3 lg:gap-x-10 lg:mx-32">
            <a href="{{ route('administradorcompras') }}">
                <button class="bg-[#2B2D2F] text-white rounded p-1 w-full h-full">Compras</button>
            </a>
            <a href="{{ route('administradorpedidos') }}">
                <button class="bg-[#2B2D2F] text-white rounded w-full h-full ">Muestras</button>
            </a>
        </div>
        @endif
        <div class="relative overflow-x-auto md:col-span-2">
            <div class="relative" wire:loading.class="opacity-70">
                <div class="absolute top-5 w-full">
                    <div wire:loading.flex class="justify-center">
                        <div class="sk-chase">
                            <div class="sk-chase-dot"></div>
                            <div class="sk-chase-dot"></div>
                            <div class="sk-chase-dot"></div>
                            <div class="sk-chase-dot"></div>
                            <div class="sk-chase-dot"></div>
                            <div class="sk-chase-dot"></div>
                        </div>
                    </div>
                </div>
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white bg-black ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3 hidden md:table-cell ">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class=" px-2 md:px-6 py-1 md:py-4 font-medium  whitespace-nowrap dark:text-white">
                                <p class="text-gray-900"> {{ $user->name }} </p>
                                <p class="md:hidden"> {{ $user->email }} </p>
                            </th>
                            <td class="px-6 py-4  hidden md:table-cell	">
                                {{ $user->email }}
                            </td>
                            <td class="">
                                <a href="/seller/compradores/{{ $user->id }}">
                                    <button class="bg-black hover:bg-primary text-white hover:text-black w-full px-1 font-bold py-2">VER
                                        PEDIDOS</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                {{ $users->links() }}
            </div>
        </div>

    </div>
    <style>
        /* Resaltar la página actual */
        .page-item.active .page-link {
            background-color: #007bff;
            /* Color de fondo de la página actual */
            border-color: #007bff;
            /* Color del borde de la página actual */
            color: white;
            /* Color del texto de la página actual */
        }

        /* Estilos adicionales para los enlaces */
        .page-item .page-link {
            color: #007bff;
            /* Color de texto de los enlaces */
            border: 1px solid #007bff;
            /* Borde de los enlaces */
        }

        .page-item .page-link:hover {
            background-color: #0056b3;
            /* Color de fondo al pasar el ratón sobre los enlaces */
            color: white;
            /* Color del texto al pasar el ratón sobre los enlaces */
            border-color: #0056b3;
            /* Color del borde al pasar el ratón sobre los enlaces */
        }

        .page-item.disabled .page-link {
            color: #6c757d;
            /* Color de texto para los enlaces deshabilitados */
            background-color: #e9ecef;
            /* Color de fondo para los enlaces deshabilitados */
            border-color: #dee2e6;
            /* Color del borde para los enlaces deshabilitados */
        }

        .sk-chase {
            width: 40px;
            height: 40px;
            position: relative;
            animation: sk-chase 2.5s infinite linear both;
        }

        .sk-chase-dot {
            width: 100%;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
            animation: sk-chase-dot 2.0s infinite ease-in-out both;
        }

        .sk-chase-dot:before {
            content: '';
            display: block;
            width: 25%;
            height: 25%;
            background-color: #000;
            border-radius: 100%;
            animation: sk-chase-dot-before 2.0s infinite ease-in-out both;
        }

        .sk-chase-dot:nth-child(1) {
            animation-delay: -1.1s;
        }

        .sk-chase-dot:nth-child(2) {
            animation-delay: -1.0s;
        }

        .sk-chase-dot:nth-child(3) {
            animation-delay: -0.9s;
        }

        .sk-chase-dot:nth-child(4) {
            animation-delay: -0.8s;
        }

        .sk-chase-dot:nth-child(5) {
            animation-delay: -0.7s;
        }

        .sk-chase-dot:nth-child(6) {
            animation-delay: -0.6s;
        }

        .sk-chase-dot:nth-child(1):before {
            animation-delay: -1.1s;
        }

        .sk-chase-dot:nth-child(2):before {
            animation-delay: -1.0s;
        }

        .sk-chase-dot:nth-child(3):before {
            animation-delay: -0.9s;
        }

        .sk-chase-dot:nth-child(4):before {
            animation-delay: -0.8s;
        }

        .sk-chase-dot:nth-child(5):before {
            animation-delay: -0.7s;
        }

        .sk-chase-dot:nth-child(6):before {
            animation-delay: -0.6s;
        }

        .opacity-70 {
            opacity: 0.7;
        }

        @keyframes sk-chase {
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes sk-chase-dot {

            80%,
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes sk-chase-dot-before {
            50% {
                transform: scale(0.4);
            }

            100%,
            0% {
                transform: scale(1.0);
            }
        }
    </style>

</div>