<div class="bg-white mx-auto h-auto w-full grid md:grid-cols-2 p-3 gap-y-2 px-20">
    <div class="font-semibold text-slate-700 py-8 flex items-center space-x-2">
        <a class="text-secondary" href="/">Inicio</a>
        <p class="text-secondary"> / </p>
        <a class="text-secondary" href="#">Mis Muestras</a>
    </div>

    <div class="md:col-end-3 col-span-1 lg:px-12 lg:ml-40">
        <label for="default-search"
            class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <!-- <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            </div>
            <input type="search"
                class="border-2 lg:block border-gray-400 py-2 text-sm bg-white rounded-md pr-10 pl-2 focus:outline-none focus:bg-white focus:text-gray-900 w-full"
                placeholder="Buscar..." autocomplete="off" name="busqueda" wire:model="search">
            <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </span> -->
        </div>
    </div>

    <div class="relative overflow-x-auto md:col-span-2 lg:mt-2 ">
        <div class="relative mb-4" wire:loading.class="opacity-70">
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
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-white bg-black  ">
                    <tr>
                        <th scope="col" class="px-3 py-2 md:px-6  md:py-5">
                            <p class="font-bold">Producto</p>
                        </th>
                        <th scope="col" class="px-3 py-2 md:px-6  md:py-3">
                            <p class="font-bold">Dirección</p>
                        </th>
                        <th scope="col" class="px-3 py-2 md:px-6  md:py-3">
                            <p class="font-bold">Estatus</p>
                        </th>
                        <th scope="col" class="px-3 py-2 md:px-6  md:py-3">
                            <p class="font-bold">Fecha de solicitud</p>
                        </th>
                        <th scope="col" class="px-3 py-2 md:px-6  md:py-3">
                            <p class="font-bold">Fecha de entrega</p>
                        </th>
                        <th scope="col" class="px-3 py-2 md:px-6  md:py-3">
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($muestras as $muestra)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">
                                {{ Str::limit($muestra->product->name, 20, '...') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ Str::limit($muestra->address, 20, '...') }}
                            </td>
                            <td class="px-6 py-4">
                                @switch($muestra->status)

                                    @case(1)
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Solicitud recibida</span>
                                        @break
                        
                                    @case(2)
                                        <span class="bg-indigo-100 text-indigo-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Muestra enviada</span>
                                        @break
                    
                                    @case(3)
                                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Muestra entregada</span>
                                        @break

                                    @case(4)
                                        <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Envío cancelada</span>
                                        @break
                    
                                    @default
                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Desconocido</span>
                                
                                @endswitch
                               
                            </td>
                            <td class="px-6 py-4">
                                {{ $muestra->created_at->format('d/m/Y') }}
                            </td>
                            <td></td>
                            <td class="w-[13%]">
                                <a href="{{ route('procesoMuestra', ['id' => $muestra->id]) }}">
                                    <button class="bg-black text-white hover:bg-primary  hover:text-black py-2 w-full px-2 hover:font-semibold ">VER MUESTRA </button>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class=" flex sm:hidden justify-center">
            {{ $muestras->onEachSide(0)->links() }}
        </div>
        <div class="hidden sm:flex justify-center">
            {{ $muestras->onEachSide(3)->links() }}
        </div>
    </div>

    <style>
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
