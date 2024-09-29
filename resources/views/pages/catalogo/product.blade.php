@extends('layouts.cotizador')
@section('title', $product->name)
@section('content')
    <div class="container mx-auto max-w-7xl">
        <div class="font-semibold text-slate-700 py-8 flex items-center space-x-2">
            <a class="text-secondary" href="/">Inicio</a>
            <p class="text-secondary"> / </p>
            <a class="text-secondary" href="#">Catálogo de productos</a>
        </div>

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
                        {{-- <p class="font-normal"> <strong>Precio Unitario: </strong>$

                            @php
                                $product_type = $product->productAttributes->where('attribute', 'Tipo Descuento')->first();
    
                              
                                $priceProduct = $product->price;
    
                                if ($product_type && $product_type->value == 'Normal') {
                                    $precioTotal = round($priceProduct - $priceProduct * (30 / 100), 2);
                                    $priceProduct = $precioTotal / config('settings.utility');
                                    
                                } elseif (
                                    $product_type &&
                                    ($product_type->value == 'Outlet' || $product_type->value == 'Unico')
                                ) {
                                    $precioTotal = round($priceProduct - $priceProduct * (0 / 100), 2);
                                    $priceProduct = $precioTotal / config('settings.utility');
                                } else {
                                    if ($product->producto_promocion) {
                                        $precioTotal = round($priceProduct - $priceProduct * ($product->descuento / 100),2,);
                                        $priceProduct = $precioTotal / config('settings.utility');
                                    } else {
                                        $priceProduct = round($priceProduct - $priceProduct * ($product->provider->discount / 100),2,);
    
                                        $precioTotal = round($priceProduct - $priceProduct * ($product->provider->discount / 100),2,);
                                        $priceProduct = $precioTotal / config('settings.utility');
                                    }
                                    if ($product->provider->company == 'EuroCotton') {
                                        $precioTotal = round($priceProduct - $priceProduct * ($product->provider->discount / 100),2,);
                                        $iva = $precioTotal * 0.16;
                                        $precioTotal = round($priceProduct - $iva, 2);
    
                                        $priceProduct = $precioTotal / config('settings.utility');
                                    }
    
                                    if ($product->provider->company == 'For Promotional') {
                                        if ($product->descuento >= $product->provider->discount) {
                                            $precioTotal = round($product->price - $product->price * ($product->descuento / 100),2,);
                                            $priceProduct = $precioTotal / config('settings.utility');
                                        } else {
                                            $precioTotal = round($product->price - $product->price * (25 / 100), 2);
                                            $priceProduct = $precioTotal / config('settings.utility');
                                        }
                                    }
                                }
    
                                $initialPrice =$precioTotal;
                            @endphp
    
                            {{ 
                                number_format($initialPrice,2);  
                            }}</p> --}}

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
                      
                            @livewire('formulario-de-cotizacion', ['product' => $product])
                      
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
                                   {{--  <p class="text-base text-stone-600 mb-2"> ${{ $product->price}}</p> --}}
                                    <br>
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
      


    </div>

    <style>
        .footer{
            display: none;
        }
    </style>
    <footer class="py-5 w-full bg-stone-900 text-white bottom-0 left-0 z-30">
        <div class="w-full flex flex-col sm:flex-row justify-between items-center text-primary mt-4">

            <div class="mb-4 sm:mb-0 pl-20">
                <img src="{{asset('img/hh-logo.png')}}" alt="logo" style="width: 180px;" class="mb-10 mt-6">
                <div class="flex">

                    @if(!Auth::user()->hasRole('invited'))

                        <a href="#" class="mr-6">
                            <svg fill="#FFFFFF" width="30px" height="30px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2.03998C6.5 2.03998 2 6.52998 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.84998C10.44 7.33998 11.93 5.95998 14.22 5.95998C15.31 5.95998 16.45 6.14998 16.45 6.14998V8.61998H15.19C13.95 8.61998 13.56 9.38998 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96C15.9164 21.5878 18.0622 20.3855 19.6099 18.57C21.1576 16.7546 22.0054 14.4456 22 12.06C22 6.52998 17.5 2.03998 12 2.03998Z"/>
                            </svg>
                        </a>
                        
                        <a href="#" class="mr-6">
                            <svg width="30px" height="30px" viewBox="0 0 41 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M31.5933 0.411377H37.7347L24.3176 15.2754L40.1018 35.5019H27.7429L18.0629 23.2346L6.98689 35.5019H0.841784L15.1927 19.6032L0.0509033 0.411377H12.7236L21.4734 11.6242L31.5933 0.411377ZM29.4379 31.9389H32.8409L10.8745 3.78727H7.22267L29.4379 31.9389Z" fill="white"/>
                            </svg>
                                
                        </a>

                        <a href="#" class="mr-6">
                            <svg width="30px" height="30px" viewBox="0 0 41 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.139 3.81317C25.4927 3.81317 26.1267 3.83798 28.2321 3.93724C30.1889 4.02823 31.2455 4.37563 31.95 4.66513C32.8814 5.04562 33.5545 5.50883 34.2511 6.24499C34.9555 6.98943 35.386 7.69251 35.7461 8.67682C36.02 9.42125 36.3488 10.5462 36.4349 12.6058C36.5288 14.8391 36.5523 15.5091 36.5523 21.1585C36.5523 26.8162 36.5288 27.4862 36.4349 29.7113C36.3488 31.7792 36.02 32.8958 35.7461 33.6402C35.386 34.6246 34.9477 35.3359 34.2511 36.0721C33.5467 36.8165 32.8814 37.2714 31.95 37.6519C31.2455 37.9414 30.1811 38.2888 28.2321 38.3798C26.1188 38.4791 25.4848 38.5039 20.139 38.5039C14.7853 38.5039 14.1513 38.4791 12.0458 38.3798C10.0891 38.2888 9.03244 37.9414 8.32801 37.6519C7.39659 37.2714 6.72347 36.8082 6.02686 36.0721C5.32243 35.3276 4.89195 34.6246 4.5319 33.6402C4.25796 32.8958 3.92922 31.7709 3.84312 29.7113C3.7492 27.478 3.72572 26.808 3.72572 21.1585C3.72572 15.5008 3.7492 14.8308 3.84312 12.6058C3.92922 10.5379 4.25796 9.42125 4.5319 8.67682C4.89195 7.69251 5.33026 6.98116 6.02686 6.24499C6.7313 5.50056 7.39659 5.04562 8.32801 4.66513C9.03244 4.37563 10.0969 4.02823 12.0458 3.93724C14.1513 3.83798 14.7853 3.81317 20.139 3.81317ZM20.139 0C14.6992 0 14.0183 0.0248145 11.8815 0.124073C9.75253 0.223331 8.28887 0.587277 7.0209 1.10838C5.69813 1.6543 4.57887 2.37392 3.46743 3.55675C2.34816 4.73131 1.66721 5.91413 1.15063 7.30375C0.657525 8.652 0.313136 10.1905 0.219212 12.4404C0.125288 14.7067 0.101807 15.4264 0.101807 21.1751C0.101807 26.9238 0.125288 27.6434 0.219212 29.9015C0.313136 32.1514 0.657525 33.6981 1.15063 35.0381C1.66721 36.436 2.34816 37.6188 3.46743 38.7934C4.57887 39.9679 5.69813 40.6958 7.01307 41.2335C8.28887 41.7546 9.7447 42.1185 11.8737 42.2178C14.0104 42.3171 14.6914 42.3419 20.1312 42.3419C25.5709 42.3419 26.2519 42.3171 28.3887 42.2178C30.5176 42.1185 31.9813 41.7546 33.2493 41.2335C34.5642 40.6958 35.6835 39.9679 36.7949 38.7934C37.9063 37.6188 38.5951 36.436 39.1039 35.0464C39.597 33.6981 39.9414 32.1596 40.0353 29.9098C40.1292 27.6517 40.1527 26.932 40.1527 21.1833C40.1527 15.4346 40.1292 14.715 40.0353 12.4569C39.9414 10.207 39.597 8.66027 39.1039 7.32029C38.6108 5.91413 37.9298 4.73131 36.8106 3.55675C35.6991 2.3822 34.5799 1.6543 33.2649 1.11665C31.9891 0.595549 30.5333 0.231602 28.4043 0.132344C26.2597 0.0248145 25.5788 0 20.139 0Z" fill="white"/>
                                <path d="M20.1389 10.2981C14.4564 10.2981 9.84631 15.17 9.84631 21.1751C9.84631 27.1803 14.4564 32.0522 20.1389 32.0522C25.8213 32.0522 30.4314 27.1803 30.4314 21.1751C30.4314 15.17 25.8213 10.2981 20.1389 10.2981ZM20.1389 28.2307C16.4523 28.2307 13.4624 25.071 13.4624 21.1751C13.4624 17.2793 16.4523 14.1195 20.1389 14.1195C23.8254 14.1195 26.8153 17.2793 26.8153 21.1751C26.8153 25.071 23.8254 28.2307 20.1389 28.2307Z" fill="white"/>
                                <path d="M33.2416 9.86773C33.2416 11.2739 32.1615 12.4071 30.8387 12.4071C29.5081 12.4071 28.4358 11.2656 28.4358 9.86773C28.4358 8.46157 29.5159 7.32837 30.8387 7.32837C32.1615 7.32837 33.2416 8.46984 33.2416 9.86773Z" fill="white"/>
                            </svg>
                        </a>

                        <a href="#" class="mr-6">
                            <svg width="30px" height="30px" viewBox="0 0 41 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M39.8047 6.48532C39.8047 6.48532 39.4135 3.56547 38.2089 2.28339C36.6835 0.595998 34.9782 0.587726 34.196 0.488468C28.5951 0.0583494 20.186 0.0583496 20.186 0.0583496H20.1703C20.1703 0.0583496 11.7612 0.0583494 6.16034 0.488468C5.3781 0.587726 3.67281 0.595998 2.14743 2.28339C0.942776 3.56547 0.559477 6.48532 0.559477 6.48532C0.559477 6.48532 0.15271 9.91799 0.15271 13.3424V16.5517C0.15271 19.9762 0.551654 23.4088 0.551654 23.4088C0.551654 23.4088 0.942776 26.3287 2.13961 27.6108C3.66498 29.2982 5.66753 29.2403 6.55929 29.4222C9.76649 29.7448 20.1782 29.8441 20.1782 29.8441C20.1782 29.8441 28.5951 29.8275 34.196 29.4057C34.9782 29.3064 36.6835 29.2982 38.2089 27.6108C39.4135 26.3287 39.8047 23.4088 39.8047 23.4088C39.8047 23.4088 40.2036 19.9844 40.2036 16.5517V13.3424C40.2036 9.91799 39.8047 6.48532 39.8047 6.48532ZM16.0401 20.4476V8.54492L26.8585 14.517L16.0401 20.4476Z" fill="white"/>
                            </svg>    
                        </a>
                    @endif
                    

                </div>
                <p class="ml-4 mr-4 text-base text-white mt-10 mb-10 pl-2">Copyright © 2024</p>
            </div>

            <div class="flex flex-col text-center items-center -mt-7">
                <img src="{{asset('img/servicio1.png')}}" alt="servicio" style="width: 60px;" class="mb-6">
                <p class="ml-4 mr-4 text-sm text-white">SERVICIO AL CLIENTE 24/7</p>
                <p class="ml-4 mr-4 text-xs text-gray-300 mt-2">Atención al cliente amigable 24 horas al día, 7 días a la semana</p>
            </div>

            <div class="flex flex-col text-center items-center -mt-7">
                <img src="{{asset('img/servicio2.png')}}" alt="garantia" style="width: 60px;" class="mb-6">
                <p class="ml-4 mr-4 text-sm text-white">GARANTÍA DE CALIDAD </p>
                <p class="ml-4 mr-4 text-xs text-gray-300 mt-2">Garantizamos la calidad en productos y servicio</p>
            </div>
        </div>
    </footer>
@endsection
