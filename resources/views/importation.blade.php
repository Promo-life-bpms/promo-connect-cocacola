@extends('layouts.cotizador')

@section('content')
<div class="bg-white">
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
                        @foreach ($products as $row)

                            @if(isset($row->firstImage) && $row->firstImage->image_url != null)
                                @php
                                    $haspvc = false;
                                    foreach ($row->productAttributes as $attribute) {
                                        if ($attribute->value === 'pvc') {
                                            $haspvc = true;
                                        }
                                    }
                                @endphp

                                @if($haspvc == false)
                                    <div class="w-full h-auto bg-white rounded-xl shadow-lg overflow-hidden p-4 sm:ml-0 md:ml-0" style="border: 1px solid #d1d1d1;">
                                        
                                        @php
                                            /* $priceProduct = $row->price;
                                            if ($row->producto_promocion) {
                                                $priceProduct = round($priceProduct - $priceProduct * ($row->descuento / 100), 2);
                                            } else {
                                                $priceProduct = round($priceProduct - $priceProduct * ($row->provider->discount / 100), 2);
                                            }
                                            $priceProduct = round($priceProduct / ((100 - $utilidad) / 100), 2); */
            
                                            if($row->provider_id == 1){
                                                /* FOR PROMOTIONAL */
                                                $priceProduct = ($row->price) * 0.93751;
                                            }else if($row->provider_id == 2){
                                                /* PROMO OPCION */
            
                                                $priceProduct = ($row->price) * 0.87502;
                                            }else if($row->provider_id == 3){
                                                /* INNOVATION */
                                                $priceProduct = ($row->price) * 1.2329;
                                            }else{
                                                /* OTRO */
                                                $priceProduct = ($row->price);
                                            }
                                            /* $priceProduct = round($row->price * 0.9375, 2); */
                                
                                        
                                        @endphp
                                        <div class="w-full flex justify-center  sm:p-5 sm:bg-white  text-center">
                                            <div class="">
                                                <img src="{{ $row->firstImage ? $row->firstImage->image_url : '' }}"
                                                    class="w-auto h-52" alt="{{ $row->name }}">
                                            </div>
                                        </div>
                                        <div class="text-center flex-grow gap-2 flex flex-col justify-between sm:block">
                                            {{-- <div class="py-2 text-lg text-slate-700">
                                                <h5 class="capitalize m-0">
                                                    {{ Str::limit($row->name, 22, '...') }}</h5>
                                                <p class="m-0">$
                                                    {{number_format($priceProduct,2)}}</p>
                                            </div> --}}
                                            <p class="mb-4 text-2lx">{{ $row->name }}</p>
                                            <a href="https://api.whatsapp.com/send?phone=5568096555&text=Hola%20me%20gustaría%20solicitar%20una%20cotización%20para%20el%20producto%20{{ $row->name }}%20con%20SKU%20:%20({{ $row->internal_sku }})"
                                                class="block w-full bg-green-500 hover:bg-green-600 text-white text-center rounded-sm font-semibold py-2 rounded-xl">
                                                Solicitar cotización
                                            </a>
                                        </div>
                                    
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
