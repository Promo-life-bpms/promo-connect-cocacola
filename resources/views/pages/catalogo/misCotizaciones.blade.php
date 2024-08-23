@extends('layouts.cotizador')

@section('content')

<div class=" mx-auto w-full px-20">
    <style>
        tr:nth-child(even) {
            background-color: #fafafa;
        }
    </style>
    @php
    $totalGeneral = 0;
    if($quotes != null){
    foreach ($quotes as $quote){
    $product = \App\Models\QuoteProducts::where('id', $quote->id)->get()->first();

    $productImage = $product->firstImage;
    $totalGeneral += intval($product->precio_total);

    }
    }

    @endphp

    @if(session('message'))
    <div class="bg-green-500 text-white p-4 mb-4">
        <p class="text-lg">¡Éxito! Se ha iniciado el proceso de compra de tu producto, puedes checar el proceso en la sección <a href="/mis-compras" style="text-decoration: underline; color: black;">MIS COMPRAS</a>.</p>
    </div>
    @elseif(session('error'))
    <div class="bg-green-500 text-white p-4 mb-4">
        <p class="text-lg">
            ¡Éxito! Se ha iniciado el proceso de compra de tu producto, puedes checar el proceso en la sección
            <a href="/mis-compras" style="text-decoration: underline; color: black;">MIS COMPRAS</a>
            <b>, sin embargo, no se envió el correo de confirmación</b>.
        </p>
    </div>


    @endif
    <div class="font-semibold text-slate-700 py-8 flex items-center space-x-2">
        <a class="text-secondary" href="/">Inicio</a>
        <p class="text-secondary"> / </p>
        <a class="text-secondary" href="#">Mis cotizaciones</a>
    </div>

    <div class="flex">
        <div class="w-1/2 mr-8">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-xl font-bold mb-2">N° de cotización:</h2>
                <p class="text-bold text-4xl">{{count($quotes) }}</p>
            </div>
        </div>

        <div class="w-1/2">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-xl font-bold mb-2">Total: </h2>
                <p class="text-bold text-4xl">$ {{ number_format($totalGeneral, 2, '.', ',') }}</p>
            </div>
        </div>

        <div class="w-1/2">

        </div>

        <div class="w-1/2">

        </div>
    </div>


    <br>
    <div class="w-full">
        <table class="table-auto">
            <thead>
                <tr class="bg-black text-white text-sm ">
                    <th class="p-4" style="width:5%;">Cotizacion</th>
                    <th style="width:5%;">Proyecto</th>
                    <th style="width:5%;">Logo</th>
                    <th style="width:10%;">Producto</th>
                    <th style="width:10%;">Usuario</th>
                    <th style="width:20%;">Detalles</th>
                    <th style="width:10%;">Tiempo de entrega</th>
                    <th style="width:10%;">Cantidad</th>
                    <th style="width:10%;">Precio unitario</th>
                    <th style="width:10%;">Total</th>
                    <th style="width:10%;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quotes as $quote)
                @php

                $product = \App\Models\QuoteProducts::where('id', $quote->id)->get()->last();
                $productData = json_decode($product->product);

                $productName = isset($productData->name) ? $productData->name : 'Nombre no disponible';
                $totalGeneral += intval($product->precio_total);

                $quoteTechnique = optional(\App\Models\QuoteTechniques::where('quotes_id', $quote->id)->latest()->first());

                $quoteInformation = App\Models\QuoteInformation::where('id', $quote->id)->first();

                $productDB = \App\Models\Catalogo\Product::where('id',$productData->id)->get()->first();
                $productImage = $productDB->firstImage;

                $proyecto = isset($productData->proyecto) ?$productData->proyecto : '';

                @endphp

                <tr class="border text-sm">
                    <td class="text-center text-">

                        <form method="POST" action="{{ route('downloadPDF') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $quote->id }}">
                            <button type="submit" class="underline font-semibold text-blue-600 text-sm">
                                SQ-{{$quote->id}}
                            </button>
                        </form>

                    </td>
                    <td>
                        {{$proyecto}}
                    </td>
                    <td class="text-center">
                        @if($quote->logo == null || $quote->logo == '')
                        <img src="{{$productImage->image_url}}" alt="" style="width: 100px;object-fit: contain;">
                        @else
                        <img class="" src="/storage/logos/{{$quote->logo}}" alt="logo" style="width: 100px;object-fit: contain;">
                        @endif
                    </td>
                    <td class="text-center">{{$productName }}</td>
                    <td class="text-center px-4">
                        <p>{{ $quote->user->name  }} </p>
                        <p>{{ $quote->user->email}}</p>
                    </td>
                    <td class="text-xs">
                        <p><b>Técnica: </b> {{isset($quoteTechnique->technique)? $quoteTechnique->technique : ''}} </p>
                        <p><b>Material: </b> {{isset($quoteTechnique->material)? $quoteTechnique->material: ''}} </p>
                        <p><b>Tamaño: </b> {{isset($quoteTechnique->size)? $quoteTechnique->size: '' }} </p>
                    </td>
                    <td class="text-center">{{ $product->dias_entrega}} dias</td>
                    <td class="text-center"> {{ $product->cantidad}} piezas</td>
                    <td class="text-center"> <b>$ {{ $product->precio_unitario}} </b> </td>
                    <td class="text-center"> <b>$ {{ number_format($product->precio_total, 2, '.', ',') }} </b> </td>
                    <td class="text-center">


                        <button data-modal-target="edit-quote-{{$quote->id}}" data-modal-toggle="edit-quote-{{$quote->id}}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mx-2 mb-2" type="button">
                            Editar cotización
                        </button>
  
                        <!-- Main modal -->
                        <div id="edit-quote-{{$quote->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 ">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-start">
                                            Cambiar status
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="edit-quote-{{$quote->id}}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>

                                    <form action="{{ route('compras.status') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        
                                        <div class="p-4 md:p-5 space-y-4">

                                            @livewire('editar-cotizacion-component', ['cotizacionId' => $quote->id])

                                        </div>

                                        <div class="flex items-center p-4 md:p-5 ">
                                            <button type="submit" class="text-white bg-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Actualizar</button>
                                            <button data-modal-hide="edit-quote-{{$quote->id}}"  type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>

                        @if( intval($product->cantidad) > intval($productDB->stock) )
                        <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Producto sin stock</span>
                        @else

                        @if($quoteInformation && $quoteInformation->information == 'Info')
                        <!-- Modal toggle -->
                        <button data-modal-target="oc-modal-{{ $quote->id }}" data-modal-toggle="oc-modal-{{ $quote->id }}" class="w-full bg-black hover:bg-primary text-white hover:text-black font-bold p-2 rounded text-xs" type="button">
                            Confirmar compra
                        </button>

                        <!-- Main modal -->
                        <div id="oc-modal-{{ $quote->id }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <form method="POST" action="{{ route('compras.realizarcompra') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $quote->id }}">
                                        <!-- Modal header -->
                                        <div class="flex justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Confirmar compra
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="oc-modal-{{ $quote->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5 space-y-4 text-left">
                                            Tu cotización pasará a un estatus de compra. Tu pedido será validado por el vendedor y se iniciará el proceso de entrega. <br>
                                            <div class="flex items-center space-x-4">

                                                {{--
                                                                    <div class="w-full">
                                                                    <label for="">Comentarios adicionales</label>
                                                                    <br>

                                                                    <textarea name="more_information" id="more_information" cols="30" rows="3" class="w-full"></textarea>
                                                                </div> --}}

                                            </div>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            <button type="submit" class="text-white bg-black hover:bg-primary hover:text-black focus:ring-4 focus:outline-none font-sm rounded-lg text-sm px-5 py-2.5 text-center">Confirmar compra</button>
                                            <button data-modal-hide="oc-modal-{{ $quote->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif

                        @endif

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-end">
            <div class="flex space-x-2 mt-2">
                {{ $quotes->links() }}
            </div>
        </div>

    </div>
    <br><br>

</div>
@endsection