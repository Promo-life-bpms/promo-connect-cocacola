@extends('layouts.cotizador')
@section('title', $product->name)
@section('content')
    <div class="container mx-auto max-w-7xl">
        <div class="font-semibold text-slate-700 py-8 flex items-center space-x-2">
            <a class="text-secondary" href="/">Inicio</a>
            <p class="text-secondary"> / </p>
            <a class="text-secondary" href="#">Catálogo de productos</a>
        </div>

        @if ($product->precio_unico)
            @php

                if($product->provider_id == 1){
                    /* FOR PROMOTIONAL */
                    $priceProduct = ($product->price) * 0.93751;
                }else if($product->provider_id == 2){
                    /* PROMO OPCION */
                    $priceProduct = ($product->price) * 0.87502;
                }else if($product->provider_id == 3){
                    /* INNOVATION */
                    $priceProduct = ($product->price) * 1.2332;
                }else{
                    /* OTRO */
                    $priceProduct = ($product->price);
                }
                /* $priceProduct = $product->price; */
            
            /*  if ($product->producto_promocion) {
                    $priceProduct = round($priceProduct - $priceProduct * ($product->descuento / 100), 2);
                } else {
                    $priceProduct = round($priceProduct - $priceProduct * ($product->provider->discount / 100), 2);
                }
                $priceProduct = round($priceProduct / ((100 - $utilidad) / 100), 2); */
            
            @endphp
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="p-4 rounded-lg">
                <div class="grid grid-cols-10 gap-4">
                    <div class="col-span-7 p-4">
                        <img id="imgBox" class="py-4 rounded" src="{{ $product->firstImage ? $product->firstImage->image_url : asset('img/default.jpg') }}"style="border: 1px solid #d1d5db;">
                    </div>
                    <div class="col-span-3  p-4 flex flex-col space-y-4">
                        @foreach ($product->images as $image)
                        <div>
                            <img class="object-scale-down rounded" src="{{ $image->image_url }}" alt="{{ $image->image_url }}" onclick="cambiarImagen(this)" style="border: 1px solid #d1d5db;">
                        </div>
                    @endforeach

                    </div>
                    
                </div>

                
            </div>
            <div class="p-4 rounded-lg">
            
                <div
                    class=" product mt-2 px-5 py-7 h-auto max-w-full h-fit w-screen">
    
                    <p class="text-4xl font-semibold mb-4 w-full" style="margin-left: 24px;">{{ $product->name }}</p>
                    
                    <div class="col-start-1 col-span-5 px-6">
                        <p class="text-lg"> Precio Unitario: $

                            @php
                              if($product->provider_id == 1){
                                /* FOR PROMOTIONAL */
                                $priceProduct = ($product->price) * 0.93751;
                            }else if($product->provider_id == 2){
                                /* PROMO OPCION */
                                $priceProduct = ($product->price) * 0.87502;
                            }else if($product->provider_id == 3){
                                /* INNOVATION */
                                $priceProduct = ($product->price) * 1.2332;
                            }else{
                                /* OTRO */
                                $priceProduct = ($product->price);
                            }
                            @endphp
    
                            {{ 
                                number_format($priceProduct,2);  
                            }}</p>

                            <p class="font-normal">Stock: <b>{{ $product->stock }}</b> </p>

                            <div class="w-full mx-auto mt-2">
                                <div class="flex border-b border-gray-300">
                                    <button
                                        class="w-1/2 py-2 text-center font-medium text-gray-700 rounded-tl-lg focus:outline-none"
                                        onclick="openTab(event, 'tab1')">Atributos </button>
                                    <button
                                        class="w-1/2 py-2 text-center font-medium text-gray-700 rounded-tr-lg focus:outline-none"
                                        onclick="openTab(event, 'tab2')">Descripcion</button>
                                </div>
                                <div id="tab1" class="tabcontent p-4">
                                <div style="margin-left:-20px;">

                                    <p class="font-normal"><strong>Descripcion:</strong>  {{ $product->description }}</p>                    

                                    @if (count($product->productCategories) > 0)
                                        <strong>Categorias</strong>
                                        {{ $product->productCategories[0]->category->family }}
                                    @endif

                                    @foreach ($product->productAttributes as $attr)
                                        @if($attr->attribute == 'Impresion')
                                            <strong >{{ $attr->attribute }}:</strong > <strong class="text-orange-500"> {{  $attr->value }}</strong>
                                        @endif
                                    @endforeach

                                    @if (!$product->precio_unico)
                                        <h5><strong>Precios</strong></h5>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Escala</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    @endif
                                    <div class="col-start-1 col-end-2">
                                        @foreach ($product->productAttributes as $attr)
                                            <p class="my-1">
                                                <strong>{{ $attr->attribute }}:</strong> {{ $attr->value }}
                                            </p>
                                        @endforeach
                                    </div>
                                    <p><strong>Ultima Actualizacion: </strong>
                                        {{ $product->updated_at->diffForHumans() }}
                                    </p>
                                    </div>
                                    
                                </div>
                                <div id="tab2" class="tabcontent p-4 hidden">
                                    <p>{{$product->description}}</p>
                                </div>
                            </div>

                            <script>
                                function openTab(evt, tabName) {
                                    var i, tabcontent, tablinks;

                                    // Ocultar todas las pestañas
                                    tabcontent = document.getElementsByClassName("tabcontent");
                                    for (i = 0; i < tabcontent.length; i++) {
                                        tabcontent[i].classList.add("hidden");
                                    }

                                    // Remover las clases de todos los botones
                                    tablinks = document.querySelectorAll(".flex button");
                                    for (i = 0; i < tablinks.length; i++) {
                                        tablinks[i].classList.remove("border-b-2", "border-blue-500", "text-blue-500");
                                    }

                                    // Mostrar la pestaña seleccionada
                                    document.getElementById(tabName).classList.remove("hidden");
                                    evt.currentTarget.classList.add("border-b-2", "border-blue-500", "text-blue-500");
                                }

                                // Por defecto, mostrar la primera pestaña
                                document.addEventListener('DOMContentLoaded', (event) => {
                                    document.querySelector('.flex button').click();
                                });
                            </script>
                        
                        <div class="w-full bg-stone-400" style="height: 1px;"></div>
                        <br>
                      
                            <p class="flex flex-grow text-lg grid-cols-1"><strong>Informacion de la cotizacion</strong></p>

                            @livewire('formulario-de-cotizacion', ['product' => $product])
                           
                    </div>
                </div>

            </div>
        </div>


      
    </div>

    <img src="{{asset('img/markethub.png')}}" alt="" class="w-full">
    

    <div class="w-full">

    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6 mt-10">Productos relacionados</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach ($recommendedProducts as $product)
                
                    <div class="flex-1 p-4 text-center items-center">

                        <div class="max-w-sm bg-white rounded-lg shadow hover-grow"style="width:240px; height:320px">
                            @if ($product->firstImage)
                            <div style="height: 168px;">
                                <img class="rounded-t-lg" src="{{ $product->firstImage->image_url }}" alt="" style="width: 70%; margin-left:15%; object-fit: contain;" />

                            </div>
                            @else
                            <div class="bg-black flex justify-center items-center" style="height: 168px;">
                                <img src="{{asset('img/hh-logo.png')}}" style="width: 70%; object-fit:contain;">

                            </div>
                            @endif
                            <div class="p-5">
                                <p class="mb-2 text-base font-bold truncate-text truncate-text" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $product->name}}</p>
                                <p class="text-base text-stone-600 mb-2"> ${{ $product->price}}</p>
                                
                                <a href="#" class="bg-black text-white font-semibold py-2 px-10 rounded mt-5">
                                    Ver más
                                </a>
                                
                            </div>
                        </div>
                    </div>

               
            @endforeach
        </div>
    </div>
    
    </div>
    <style>
        .product-small-img img {
            width: 4%;
            border: 1px solid rgba(0, 0, 0, .2);
            /* padding: 8px; */
            /* margin: 10px 10px 15px; */
            cursor: pointer;
        }

        .product-small-img {
            display: flex;
            /* justify-content: center; */
            flex-direction: column;
            gap: 5px;
        }

        .img-container {
            border: 1px solid rgba(0, 0, 0, .2);
        }

        .img-container img {
            height: 20rem;
        }

        .img-container {
            padding: 10px;
            max-height: 400px;
        }
    </style>
    <script>
        function cambiarImagen(smallImg) {
            let fullImg = document.querySelector('#imgBox')
            console.log(fullImg);
            fullImg.src = smallImg.src
        }
    </script>

@endsection
