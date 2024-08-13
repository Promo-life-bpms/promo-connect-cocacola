@php
$layout = auth()
->user()
->hasRole(['seller', "buyers-manager"])
? 'cotizador'
: 'app';
@endphp

@extends('layouts.' . $layout)


@section('content')
<div class="">
    <div>
        @foreach ($infouser as $user)
        <div class="row px-3">
            <div class="card w-100">
                <div class="card-body">
                    <div class="bg-white mx-auto h-auto w-full grid md:grid-cols-2 p-3 gap-y-2">

                        <div class="relative  md:col-span-2  lg:mx-32 lg:mt-2 ">
                            <h1 class="font-semibold text-2xl" style="font-size: 30px;">Información Del Usuario</h1>
                            <br>
                            <div style="font-size: 20px;">
                                <strong>Nombre:</strong>
                                <span>{{ $user->name }}</span>
                            </div>
                            <div style="font-size: 20px;">
                                <strong>Email:</strong>
                                <span>{{ $user->email }}</span>
                            </div>

                        </div>

                        <div class="relative overflow-y-auto md:col-span-2  lg:mx-32 lg:mt-2 ">
                            <strong>COTIZACIONES</strong>
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
                                            <th scope="col" class="px-3 py-2 md:px-6  md:py-3 text-center">
                                                No. Orden de compra
                                            </th>
                                            <th scope="col" class="px-3 py-2 md:px-6  md:py-3 text-center">
                                                Imagen
                                            </th>
                                            <th scope="col" class="px-3 py-2 md:px-6  md:py-3 text-center">
                                                Producto
                                            </th>
                                            <th scope="col" class="px-3 py-2 md:px-6  md:py-3 text-center">
                                                Descripción
                                            </th>
                                            <th scope="col" class="px-3 py-2 md:px-6  md:py-3 text-center">
                                                Cantidad
                                            </th>
                                            <th scope="col" class="px-3 py-2 md:px-6  md:py-3 text-center">
                                                Total
                                            </th>
                                            <th scope="col" class="px-3 py-2 md:px-6  md:py-3 text-center">
                                                Fecha
                                            </th>
                                            <!--<th scope="col" class="px-3 py-2 md:px-6  md:py-3 text-center">
                                                Status
                                            </th>-->
                                            <!--<th scope="col" class="px-3 py-2 md:px-6  md:py-3 text-center">

                                            </th>-->
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($longitudcompras > 0)
                                        @foreach ($compras as $compra)
                                        <?php
                                        $price = $compra->precio_unitario;
                                        ?>
                                        @php
                                        $infoProduc = json_decode($compra->product);
                                        $productDB = \App\Models\Catalogo\Product::where('id',$infoProduc->id)->get()->first();
                                        $productImage = $productDB->firstImage;
                                        @endphp
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4">
                                                OC-{{$compra->id}}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                @if($compra['logo'] != '')
                                                <img src="/storage/logos/{{$compra['logo'] }}" alt="" style="width: 100px;object-fit: contain;">
                                                @else
                                                <img src="{{$productImage->image_url}}" alt="" style="width: 100px;object-fit: contain;">
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{$infoProduc->name}}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{$infoProduc->description}}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{$compra->cantidad}}
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <span> ${{ number_format($compra->precio_total, 2, '.', ',') }}</span>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                {{ $compra->created_at->format('d-m-Y')}}
                                            </td>
                                            <!--<td class="text-center">
                                                @switch($compra->status)
                                                @case(0)
                                                <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">En validación OC</span>
                                                @break
                                                @case(1)
                                                <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">En proceso de compra</span>
                                                @break
                                                @case(2)
                                                <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-700/10">Error en número de compra</span>
                                                @break
                                                @case(3)
                                                <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Entregado</span>
                                                @break
                                                @endswitch
                                            </td>-->
                                            <!-- <td class="w-[15%]">
                                                <a href="{{ route('verCotizacion', ['quote' => $compra->id]) }}" class="btn-sm"> <button class="bg-black text-white hover:bg-primary hover:text-black font-bold w-full px-2 py-2">VER
                                                        COMPRA</button>
                                                </a>
                                            </td>-->
                                        </tr>
                                        @endforeach
                                        @else
                                        <td colspan="6" class=" text-center">
                                            No tiene compras por el momento
                                        </td>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="relative overflow-y-auto md:col-span-2  lg:mx-32 lg:mt-2 ">
                            <strong>MUESTRAS</strong>
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
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 col-span-2">
                                    <thead class="text-xs text-white bg-black">
                                        <tr>
                                            <th scope="col" class="px-3 py-2 md:px-6  md:py-3">
                                                Fecha
                                            </th>
                                            <th scope="col" class="px-3 py-2 md:px-6  md:py-3">
                                                Dirección
                                            </th>
                                            <th scope="col" class="px-3 py-2 md:px-6  md:py-3">
                                                Producto
                                            </th>
                                            <th scope="col" class="px-3 py-2 md:px-6  md:py-3">
                                                Estatus
                                            </th>
                                            <th scope="col" class="px-3 py-2 md:px-6  md:py-3">

                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if ($longitudmuestras > 0)
                                        @foreach ($muestras as $muestra)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="px-6 py-4">
                                                {{ $muestra->updated_at }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $muestra->address }}

                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $muestra->product_name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @switch($muestra->status)
                                                @case(1)
                                                <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">Se esta preparando</span>
                                                @break
                                                @case(2)
                                                <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">Va en camino</span>
                                                @break
                                                @case(4)
                                                <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Ya se entrego</span>
                                                @break
                                                @case(3)
                                                <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-700/10">Cancelada</span>
                                                @break
                                                @endswitch
                                            </td>
                                            <td class="w-[13%]">
                                                <a href="/carrito/muestra/{{ $muestra->id_muestra }}">
                                                    <button class="bg-black text-white hover:bg-primary hover:text-black font-bold w-full px-2 py-2">VER
                                                        PEDIDO </button>
                                                </a>
                                            </td>

                                        </tr>
                                        @endforeach
                                        @else
                                        <td colspan="5" class=" text-center">
                                            No tiene muestras por el momento
                                        </td>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="relative overflow-y-auto md:col-span-2  lg:mx-32 lg:mt-2 ">
                            <strong>COMPRAS</strong>
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

                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 col-span-2">
                                    <thead class="text-xs text-white bg-black">
                                        <tr class="bg-black text-white">
                                            <th class="p-4" style="width: 10%;" class="p-2">#</th>
                                            <th style="width: 10%;">Imagen</th>
                                            <th style="width: 10%;">Usuario </th>
                                            <th style="width: 10%;">Producto</th>
                                            <th style="width: 20%;">Descripción</th>
                                            <th style="width: 10%;">Cantidad</th>
                                            <th style="width: 10%;">Total</th>
                                            <th style="width: 10%;">Fecha de pedido</th>
                                            <th style="width: 10%;">Fecha de entrega</th>
                                            <th style="width: 10%;">Status</th>
                                            @role('seller')
                                            <th style="width: 5%;"></th>
                                            @endrole
                                        </tr>
                                    </thead>
                                    <tbody class="text-sm">
                                        @foreach ($shoppings as $shopping)
                                        @php
                                        $product = json_decode($shopping->products[0]->product, true);
                                        $productDB = \App\Models\Catalogo\Product::where('id',$product['id'])->get()->first();
                                        $productImage = $productDB->firstImage;
                                        $shoppingInformation = \App\Models\ShoppingInformation::where('id',$shopping->id)->get()->first();
                                        @endphp
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td class="text-center py-5 px-6">OC-{{ $shoppingInformation->id }}</td>
                                            <td class="text-center">
                                                @if($product['logo'] != '')
                                                <img src="/storage/logos/{{$product['logo'] }}" alt="" style="width: 100px;object-fit: contain;">
                                                @else
                                                <img src="{{$productImage->image_url}}" alt="" style="width: 100px;object-fit: contain;">
                                                @endif
                                            </td>

                                            <td class="text-center px-4">
                                                <p>{{ $shopping->user->name  }} </p>
                                                <p>{{ $shopping->user->email}}</p>
                                            </td>
                                            <td class="text-center">
                                                {{ $product['name'] }}
                                            </td>
                                            <td>
                                                {{ $product['description'] }}
                                            </td>
                                            <td class="text-center">
                                                {{ $shopping->products[0]->cantidad }}
                                            </td>
                                            <td class="text-center">
                                                <b>$ {{ number_format($shopping->products[0]->precio_total, 2, '.', ',') }}</b>
                                            </td>
                                            <td class="text-center">
                                                {{ $shopping->products[0]->created_at->format('d-m-Y') }}
                                            </td>
                                            <td class="text-center">
                                                @if($shopping->status == 3)
                                                <p>Entregado el: </p>
                                                {{ $shopping->products[0]->updated_at->format('d-m-Y') }}
                                                @else
                                                Estimada:
                                                <br>
                                                {{ $shopping->products[0]->updated_at->addDays(10)->format('d-m-Y') }}
                                                @endif

                                            </td>
                                            <td class="text-center">
                                                @switch($shopping->status)
                                                @case(0)
                                                <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">En validación OC</span>
                                                @break
                                                @case(1)
                                                <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">En proceso de compra</span>
                                                @break
                                                @case(2)
                                                <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-700/10">Error en número de compra</span>
                                                @break
                                                @case(3)
                                                <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Entregado</span>

                                                @if($shoppingInformation->oportunity == 'Completado')
                                                <br>
                                                <span class="bg-orange-100 text-orange-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Evaluado</span>
                                                @else
                                                <button data-modal-target="rating-modal-{{$shopping->id}}" data-modal-toggle="rating-modal-{{$shopping->id}}" class="block text-white bg-primary hover:bg-primary focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center ml-8 " type="button">
                                                    Evaluar
                                                </button>

                                                @endif
                                                <!-- Main modal -->
                                                <div id="rating-modal-{{$shopping->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    ¡Califica nuestro servicio!
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="rating-modal-{{$shopping->id}}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                    </svg>
                                                                    <span class="sr-only">Cerrar modal</span>
                                                                </button>
                                                            </div>

                                                            <form method="POST" action="{{ route('shoppingRate') }}">
                                                                @csrf

                                                                <input type="text" name="shopping_id" id="shopping_id" hidden value="{{$shopping->id}}">
                                                                <!-- Modal body -->
                                                                <div class="p-4 md:p-5 space-y-4">
                                                                    <p class="">
                                                                        Valoramos tu experiencia con nuestro servicio y productos, por favor, tómate un momento para evaluarnos. Tu retroalimentación nos ayuda a mejorar y a seguir ofreciéndote la mejor atención posible. ¡Gracias por tu apoyo!
                                                                    </p>
                                                                    <br>

                                                                    <div class="flex items-center justify-center space-x-2">
                                                                        <input type="hidden" name="rating" id="rating" value="0" class="hidden">

                                                                        <label for="star{{$shopping->id}}1" id="star{{$shopping->id}}1s" class="text-2xl cursor-pointer" onclick="setRating(1, '{{$shopping->id}}')">&#9733;</label>
                                                                        <input type="radio" id="star{{$shopping->id}}1" name="star" value="1" class="hidden" />

                                                                        <label for="star{{$shopping->id}}2" id="star{{$shopping->id}}2s" class="text-2xl cursor-pointer" onclick="setRating(2, '{{$shopping->id}}')">&#9733;</label>
                                                                        <input type="radio" id="star{{$shopping->id}}2" name="star" value="2" class="hidden" />

                                                                        <label for="star{{$shopping->id}}3" id="star{{$shopping->id}}3s" class="text-2xl cursor-pointer" onclick="setRating(3, '{{$shopping->id}}')">&#9733;</label>
                                                                        <input type="radio" id="star{{$shopping->id}}3" name="star" value="3" class="hidden" />

                                                                        <label for="star{{$shopping->id}}4" id="star{{$shopping->id}}4s" class="text-2xl cursor-pointer" id="star{{$shopping->id}}4s" onclick="setRating(4, '{{$shopping->id}}')">&#9733;</label>
                                                                        <input type="radio" id="star{{$shopping->id}}4" name="star" value="4" class="hidden" />

                                                                        <label for="star{{$shopping->id}}5" id="star{{$shopping->id}}5s" class="text-2xl cursor-pointer" onclick="setRating(5, '{{$shopping->id}}')">&#9733;</label>
                                                                        <input type="radio" id="star{{$shopping->id}}5" name="star" value="5" class="hidden" />
                                                                    </div>
                                                                </div>

                                                                <!-- Modal footer -->
                                                                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                    <button type="submit" class="text-white bg-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Evaluar</button>
                                                                    <button data-modal-hide="rating-modal-{{$shopping->id}}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cerrar</button>
                                                                </div>

                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>

                                                <script>
                                                    function setRating(value, id) {

                                                        initValue = `${id}${1}`;
                                                        maxValue = `${id}${5}`;

                                                        for (let i = 1; i <= value; i++) {
                                                            star = document.getElementById(`star${id}${i}s`);
                                                            star.style.color = '#F35A02';
                                                        }

                                                        for (let i = value + 1; i <= 5; i++) {
                                                            star = document.getElementById(`star${id}${i}s`);
                                                            star.style.color = '#000000';
                                                        }
                                                    }
                                                </script>
                                                @break
                                                @default

                                                @endswitch
                                                <br>
                                            </td>
                                            @role('seller')
                                            <td>
                                                <!-- Modal toggle -->
                                                <button data-modal-target="edit-modal-{{$shopping->id}}" data-modal-toggle="edit-modal-{{$shopping->id}}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mx-2" type="button">
                                                    Cambiar status
                                                </button>

                                                <!-- Main modal -->
                                                <div id="edit-modal-{{$shopping->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 ">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-start">
                                                                    Cambiar status
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="edit-modal-{{$shopping->id}}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>

                                                            <form action="{{ route('compras.status.of.buyers') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('POST')

                                                                <div class="p-4 md:p-5 space-y-4">

                                                                    <input type="text" value="{{$shopping->id}}" name="shopping_id" hidden>
                                                                    <input type="text" value="{{$user->id}}" name="user_id" hidden>
                                                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                                                    <select id="status" name="status" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                        <option value="0" {{ $shopping->status == 0 ? 'selected' : '' }}>En validación OC</option>
                                                                        <option value="1" {{ $shopping->status == 1 ? 'selected' : '' }}>En proceso de compra</option>
                                                                        <option value="2" {{ $shopping->status == 2 ? 'selected' : '' }}>Error en número de compra</option>
                                                                        <option value="3" {{ $shopping->status == 3 ? 'selected' : '' }}>Entregado</option>
                                                                    </select>

                                                                </div>

                                                                <div class="flex items-center p-4 md:p-5 ">
                                                                    <button type="submit" class="text-white bg-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Actualizar</button>
                                                                    <button data-modal-hide="edit-modal-{{$shopping->id}}" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                                                                </div>

                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            @endrole
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

                            .opacity-70 {
                                opacity: 0.7;
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
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection