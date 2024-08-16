<div class="mx-auto">
    @php
        $priceProduct = $product->price;
    @endphp
    @if ($product->precio_unico)
        @php
            if ($product->producto_promocion) {
                $priceProduct = round($priceProduct - $priceProduct * ($product->descuento / 100), 2);
            } else {
                $priceProduct = round($priceProduct - $priceProduct * ($product->discount / 100), 2);
            }
        @endphp
    @endif

    
    <div class="container mx-auto max-w-7xl py-2">
        <div class="flex flex-col md:flex-row p-2 md:gap-x-5 gap-y-4 lg:gap-x-24">
            <div class="w-full md:w-2/3 lg:w-[62%]">
                <div class="bg-stone-50 rounded-lg grid grid-cols-2 gap-x-6 p-4 lg:gap-x-0">

                    <div class="col-span-2 ">
                        <button wire:click="goBack" class="lg:hidden">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-7 h-7 lg:w-9 lg:h-9 lg:mb-4 block mb-2"
                                style="display: inline">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                            </svg>
                        </button>

                        <strong class="text-2xl lg:text-4xl m-"> PROCESO DE ENTREGA </strong>
                    </div>

                    <div class="tabs col-span-2 flex justify-center">
                        <div class="border-b border-gray-200 dark:border-gray-700">
                            <ul class="flex flex-wrap  text-sm text-center text-gray-500 dark:text-gray-400">
                                <li class="mr-2">
                                    <a href="#"
                                        class="inline-flex p-1 px-2 border-b-2  rounded-t-lg
                                        {{ $muestra->status >= 1 ? 'text-black' : 'text-[#B3B2B2]' }}
                                        {{ $muestra->status === 1 ? 'border-black' : 'border-transparent' }}">
                                        <div
                                            class="rounded-full  text-[#F2F2F2] h-6 w-6 mr-2 flex justify-center pt-[0.5px]
                                            {{ $muestra->status >= 1 ? 'bg-black' : 'bg-[#B3B2B2] ' }}">
                                            1
                                        </div>
                                        TU MUESTRA SE ESTA PREPARANDO
                                    </a>
                                </li>
                                <li class="mr-2">
                                    <a href="#"
                                        class="inline-flex p-1 px-2 border-b-2  rounded-t-lg
                                        {{ $muestra->status >= 2 ? 'text-black' : 'text-[#B3B2B2]' }}
                                        {{ $muestra->status === 2 ? 'border-black' : 'border-transparent' }}">
                                        <div
                                            class="rounded-full  text-[#F2F2F2] h-6 w-6 mr-2 flex justify-center pt-[0.5px]
                                            {{ $muestra->status >= 2 ? 'bg-black' : 'bg-[#B3B2B2] ' }}">
                                            2
                                        </div>
                                        TU MUESTRA VA EN CAMINO
                                    </a>
                                </li>
                                <li class="mr-2">
                                    <a href="#"
                                        class="inline-flex p-1 px-2 border-b-2  rounded-t-lg
                                    {{ $muestra->status >= 4 ? 'text-black' : 'text-[#B3B2B2]' }}
                                    {{ $muestra->status === 4 ? 'border-black' : 'border-transparent' }}">
                                        <div
                                            class="rounded-full  text-[#F2F2F2] h-6 w-6 mr-2 flex justify-center pt-[0.5px]
                                        {{ $muestra->status >= 4 ? 'bg-black' : 'bg-[#B3B2B2] ' }}">
                                            4
                                        </div>
                                        ENTREGADO
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class=" col-span-2 p-5 flex justify-around w-full">
                        <p><strong>Fecha de solicitud: </strong>{{ $muestra->created_at->format('d-m-Y') }}</p>
                        <p><strong>Fecha de entrega aproximada: </strong>{{ $muestra->estimated_delivery != null ?  \Carbon\Carbon::parse($muestra->estimated_delivery)->format('d-m-y')  : ''}} 

                            <button data-modal-target="edit-date-modal" data-modal-toggle="edit-date-modal" type="button">
                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                          
                      
                            <div id="edit-date-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">

                                    <form action="{{ route('seller.especialCambiarFecha') }}" method="POST">
                                        @csrf
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Cambiar fecha de entrega aproximada
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-date-modal">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="p-4 md:p-5 space-y-4">
                                                <input type="text" name="id" hidden value="{{ $muestra->id}}">
                                                <label for="date" class="block text-sm font-medium text-gray-700">Seleccione una fecha</label>
                                                <input type="date" id="date" name="date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary sm:text-sm" required>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button data-modal-hide="" type="submit" class="text-black bg-primary hover:bg-black hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cambiar</button>
                                                <button data-modal-hide="edit-date-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100  focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        
                        </p>
                    </div>
                    <div class="flex justify-center py-16 md:py-9 lg:py-3 lg:justify-center ">
                        <img src="{{ $product->images_selected ?: ($product->firstImage ? $product->firstImage->image_url : asset('img/default.jpg')) }}"
                            alt="" class="w-auto h-40">
                    </div>
                    <div class="grid grid-cols-1 gap-y-1">
                        <div>
                            <strong>{{ $product->name }}</strong>
                        </div>
                        <div>
                            @if ($muestra->status === 1)
                                <strong class="">ESTAMOS PREPARANDO TU PEDIDO</strong>
                            @endif
                            @if ($muestra->status === 2)
                                <strong class="">TU PEDIDO YA ESTA LISTO Y VA EN CAMINO</strong>
                            @endif
                            @if ($muestra->status === 4)
                                <strong class="">TU PEDIDO SE TE HA ENTREGADO CORRECTAMENTE</strong>
                            @endif
                        </div>
                        <div>
                            <strong>Precio unitario:</strong>
                            <span>$ {{ round($priceProduct / ((100 - $utilidad) / 100), 2) }}</span>
                        </div>
                        <div>
                            <strong>Descripción:
                            </strong>
                        </div>
                        <div>
                            <span> {{ $product->description }}
                            </span>
                        </div>
                    </div>
                </div>
                {{-- Colocar una seccion para la informacion de la  muestra que tiene name, address y phone --}}
                <div class="bg-stone-50 rounded-lg grid grid-cols-2 gap-x-6 p-4 lg:gap-x-0 mt-4">
                    <div class="grid grid-cols-1 gap-y-1">
                        <div>
                            <strong>Detalles Adicionales</strong>
                        </div>
                        <div>
                            <strong>Tipo de muestra:</strong>
                            <span>{{ $muestra->type }}</span>
                        </div>
                        <div>
                            <strong>Nombre:</strong>
                            <span>{{ $muestra->name }}</span>
                        </div>
                        <div>
                            <strong>Teléfono:</strong>
                            <span>{{ $muestra->phone }}</span>
                        </div>
                        <div>
                            <strong>Dirección:</strong>
                            <span>{{ $muestra->address }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/3 lg:w-1/4">
                @role('seller')
                    <div class="flex-grow space-y-3">
                        <div class="flex items-center space-x-3 mt-2">
                            <strong>Estado de la muestra:</strong>
                            <select wire:model="productStatus"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-[45%] p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="1">Se esta preparando</option>
                                <option value="2">Va en camino</option>
                                <option value="3">Cancelada</option>
                                <option value="4">Ya se entrego</option>
                                
                            </select>
                        </div>

                        <div class="flex items-center space-x-3 mt-2">
                            <button
                                class="block w-full bg-primary text-black hover:bg-black hover:text-white text-center rounded-sm font-semibold py-1 px-4"
                                wire:click='updateMuestraStatus'>
                                Confirmar Cambio De Estado
                            </button>
                        </div>
                    </div>
                    <br>
                @endrole
                <div class="h-[500px] overflow-x-clip rounded-lg bg-stone-50 py-4 p-5 flex flex-col">
                    <strong class="text-center pb-3">Atencion a cliente</strong>
                    <div class="flex-grow bg-stone-50  overflow-y-auto">
                        <ul class="flex flex-col space-y-2">
                            @foreach ($comments as $message)
                                @if ($message->role_id == 2)
                                    <li class=" flex justify-start">
                                        <div class="w-3/4 bg-slate-100 rounded-2xl px-2 py-1">
                                            <p class="text-left text-sm"><strong>{{ $message->name }}</strong></p>
                                            <p class="text-left">{{ $message->message }}</p>
                                            <p class="text-right text-sm text-gray-500">
                                                {{ $message->created_at->format('H:i:s') }}</p>
                                        </div>
                                    </li>
                                @else
                                    <li class=" flex justify-end">
                                        <div class="w-3/4 bg-blue-500 rounded-2xl px-2 py-1">
                                            <p class="text-left text-white text-sm">
                                                <strong>{{ $message->name }}</strong>
                                            </p>
                                            <p class="text-left text-white">{{ $message->message }}</p>
                                            <p class="text-right text-sm text-white">
                                                {{ $message->created_at->format('H:i:s') }}</p>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <form wire:submit.prevent="addMessage" class="mt-4 flex space-x-1 w-full">
                        <input wire:model="message" class="border border-gray-300 rounded p-2">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded">Enviar</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script>
        window.addEventListener('cambio-status', event => {
            Swal.fire({
                icon: "success",
                title: "Se ha hactualizado el estado de la muestra",
                showConfirmButton: false,
                timer: 3000
            })
        });
    </script>
</div>
