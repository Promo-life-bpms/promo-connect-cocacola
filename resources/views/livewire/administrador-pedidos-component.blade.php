<div class="bg-white mx-auto h-auto w-full grid md:grid-cols-2 p-3 gap-y-2 px-20">
    <div class="font-semibold text-slate-700 py-8 flex items-center space-x-2">
        <a class="text-secondary" href="/">Inicio</a>
        <p class="text-secondary"> / </p>
        <a class="text-secondary" href="#">Muestras</a>
    </div>
    <br>

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
                <thead class="text-xs text-white  bg-black">
                    <tr>
                        <th scope="col" style="width:10px;" class="px-3 py-2 md:px-6 md:py-3">
                            #
                        </th>
                        <th scope="col" class="px-3 py-2 md:px-6  md:py-3">
                            PRODUCTO
                        </th>
                        <th scope="col" class="px-3 py-2 md:px-6  md:py-3">
                            SOLICITANTE
                        </th>
                        <th scope="col" class="px-3 py-2 md:px-6  md:py-3">
                            FECHA DE CREACIÓN
                        </th>
                        <th scope="col" class="px-3 py-2 md:px-6  md:py-3">
                            DIRECCIÓN
                        </th>
                        
                        <th scope="col" class="px-3 py-2 md:px-6  md:py-3">
                            TIPO
                        </th>
                      
                        <th scope="col" class="px-3 py-2 md:px-6  md:py-3">
                            FECHA ESTIMADA DE ENTREGA
                        </th>
                        <th scope="col" class="px-3 py-2 md:px-6  md:py-3">
                            ESTATUS
                        </th> 
                        <th scope="col" class="px-3 py-2 md:px-6  md:py-3">

                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($muestras as $muestra)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4  hidden md:table-cell">
                                {{ $muestra->product_name }}
                            </td>
                            <th scope="row"
                                class="px-6 py-4  hidden md:table-cell font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $muestra->user_name }}
                            </th>
                            <td class="px-6 py-4  hidden md:table-cell">
                                {{
                                    \Carbon\Carbon::parse($muestra->created_at)->format('d-m-y') 
                                }}
                            </td>
                            <td class="px-6 py-4  hidden md:table-cell">
                                {{ $muestra->address }}
                            </td>
                            
                            <td class="px-6 py-4  hidden md:table-cell">
                                {{ $muestra->product_type }}
                            </td>
                  
                            <td class="px-6 py-4  hidden md:table-cell">

                                {{ $muestra->estimated_delivery != null? $muestra->estimated_delivery: 'Sin fecha confirmada' }}
                            </td>
                         

                            <td class="px-6 py-4  hidden md:table-cell">
                                @switch($muestra->status)
                                    @case(1)
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Se está preparando</span>
                                        @break
                                    @case(2)
                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Va en camino</span>
                                        @break
                                    @case(3)
                                        <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Cancelada</span>
                                        @break
                                    @case(4)
                                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Entregada</span>
                                        @break
                                    @default
                                        
                                @endswitch
                            </td>
                            <td class="px-6 py-4  hidden md:table-cell">
                                <a href="/carrito/muestra/{{ $muestra->id_muestra }}">
                                    <button class="bg-[#2B2D2F] text-white h-[50px] w-full px-2 ">VER DETALLES </button>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
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

