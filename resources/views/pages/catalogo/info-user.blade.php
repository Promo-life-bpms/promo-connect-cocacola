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
                                            <th scope="col" class="px-3 py-2 md:px-6  md:py-3 text-center">
                                                Status
                                            </th>
                                            <th scope="col" class="px-3 py-2 md:px-6  md:py-3 text-center">

                                            </th>
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
                                            <td class="text-center">
                                                @switch($compra->status)
                                                @case(1)
                                                <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">En validación OC</span>
                                                @break
                                                @case(2)
                                                <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">En proceso de compra</span>
                                                @break
                                                @case(3)
                                                <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-700/10">Error en número de compra</span>
                                                @break
                                                @case(4)
                                                <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Entregado</span>
                                                @break
                                                @endswitch
                                            </td>
                                            <td class="w-[15%]">
                                                <a href="{{ route('verCotizacion', ['quote' => $compra->id]) }}" class="btn-sm"> <button class="bg-black text-white hover:bg-primary hover:text-black font-bold w-full px-2 py-2">VER
                                                        COMPRA</button>
                                                </a>
                                            </td>
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
                                                @case(3)
                                                <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Ya se entrego</span>
                                                @break
                                                @case(4)
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