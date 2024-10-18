@extends('layouts.cotizador')

@section('content')
<div class="bg-white mx-10">
    <div class="container mx-auto w-full px-2 mt-6">
        <div class="font-semibold text-slate-700 py-8 flex items-center space-x-2">
            <a class="text-secondary" href="/">Inicio</a>
            <p class="text-secondary"> / </p>
            <a class="text-secondary" href="#">Importación</a>
        </div>


        <div class="flex w-full flex-col md:flex-row">
            <style>
                .container1 {
                    width:400px;
                    margin: 0;
                }

                @media (max-width: 767px) {
                    .container1 {
                        width:100%;
                        margin: 0;
                        padding: 0 0 10% 5%;
                    }
                }
            </style>
            <div class="w-full sm:w-full md:w-70">
                <div class="relative mt-8" wire:loading.class="opacity-40">
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
                    @if (count($products) <= 0)
                        <div class="flex flex-wrap justify-center items-center flex-col  text-slate-700">
                            <p>No hay resultados de busqueda en la pagina actual</p>
                            @if (count($products->items()) == 0 && $products->currentPage() > 1)
                                <p>Click en la paginacion para ver mas resultados</p>
                            @endif
                        </div>
                    @endif
                    <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-3 gap-8 pb-8 -mt-8">
                        @foreach ($products as $product)

                            @if(isset($product->firstImage) && $product->firstImage->image_url != null)
                                @php
                                    $haspvc = false;
                                    foreach ($product->productAttributes as $attribute) {
                                        if ($attribute->value === 'pvc') {
                                            $haspvc = true;
                                        }
                                    }
                                @endphp

                                @if($haspvc == false)
                                    <div class="border border-gray-300 rounded-2xl shadow-lg p-4 bg-white">
                                        @php
                                            /* $priceProduct = $row->price;
                                            if ($row->producto_promocion) {
                                                $priceProduct = round($priceProduct - $priceProduct * ($row->descuento / 100), 2);
                                            } else {
                                                $priceProduct = round($priceProduct - $priceProduct * ($row->provider->discount / 100), 2);
                                            }
                                            $priceProduct = round($priceProduct / ((100 - $utilidad) / 100), 2); */

                                            if($product->provider_id == 1){
                                                /* FOR PROMOTIONAL */
                                                $priceProduct = ($product->price) * 0.93751;
                                            }else if($product->provider_id == 2){
                                                /* PROMO OPCION */

                                                $priceProduct = ($product->price) * 0.87502;
                                            }else if($product->provider_id == 3){
                                                /* INNOVATION */
                                                $priceProduct = ($product->price) * 1.2329;
                                            }else{
                                                /* OTRO */
                                                $priceProduct = ($product->price);
                                            }
                                            /* $priceProduct = round($row->price * 0.9375, 2); */
                                        @endphp
                                        <img src="{{ $product->firstImage ? $product->firstImage->image_url : '' }}" alt="Producto 1" class="w-full h-auto object-cover rounded-lg mb-4 max-h-64">
                                        <h3 class="text-lg font-bold text-primary mb-2 text-center font-TCCCUnityHeadline">{{ strtolower($product->name) }}</h3>
                                        <p class="text-lg font-bold text-primary mb-2 capitalize truncate whitespace-nowrap overflow-hidden">${{ $product->price}}</p>
                                        <a href="{{ route('show.product', ['product' => $product->id]) }}">
                                            <button class="w-full flex items-center justify-center bg-primary text-white py-2 rounded-lg hover:bg-primary-light transition duration-300">
                                                <svg width="27" height="26" viewBox="0 0 27 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.32664 12.2868C5.56683 14.4488 5.68693 15.5296 6.41437 16.1807C7.1418 16.8318 8.22936 16.8318 10.4045 16.8318H10.565H15.3736H17.1061C18.6046 16.8318 19.3537 16.8318 19.9617 16.4657C20.5697 16.0996 20.9203 15.4375 21.6214 14.1132L24.774 8.1584C25.4518 6.87797 24.5236 5.3363 23.0748 5.3363H10.565H10.2626C7.59855 5.3363 6.26655 5.3363 5.50499 6.18717C4.74342 7.03803 4.89053 8.36188 5.18472 11.0096L5.32664 12.2868Z" fill="#171616" stroke="white" stroke-width="2.5" stroke-linejoin="round"/>
                                                    <path d="M2 1.50452H2.63864C3.487 1.50452 4.19969 2.14241 4.29338 2.98558L5.26417 11.7227" fill="white"/>
                                                    <path d="M2 1.50452H2.63864C3.487 1.50452 4.19969 2.14241 4.29338 2.98558L5.26417 11.7227" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M9.66367 22.5795C9.66367 23.6376 8.80589 24.4954 7.74776 24.4954C6.68963 24.4954 5.83185 23.6376 5.83185 22.5795C5.83185 21.5214 6.68963 20.6636 7.74776 20.6636C8.80589 20.6636 9.66367 21.5214 9.66367 22.5795Z" fill="white" stroke="white" stroke-width="2.5"/>
                                                    <path d="M21.1591 22.5795C21.1591 23.6376 20.3013 24.4954 19.2432 24.4954C18.1851 24.4954 17.3273 23.6376 17.3273 22.5795C17.3273 21.5214 18.1851 20.6636 19.2432 20.6636C20.3013 20.6636 21.1591 21.5214 21.1591 22.5795Z" fill="white" stroke="white" stroke-width="2.5"/>
                                                </svg>
                                                Agregar
                                            </button>
                                        </a>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>

</div>
@endsection
