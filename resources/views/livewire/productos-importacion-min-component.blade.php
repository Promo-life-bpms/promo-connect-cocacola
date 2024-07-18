<div class="bg-white">
    <img src="{{asset('img/banner_productos.png')}}" alt="" class="w-full" style="margin-top: -12px;">
    <div class="container mx-auto w-full px-10">

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
            <div class="container1" >

                <div id="accordion-open" data-accordion="close">
                    <h2 id="accordion-open-heading-1">

                      <button type="button" class="flex items-center justify-between w-full p-5 font-medium " data-accordion-target="#accordion-open-body-1" aria-expanded="true" aria-controls="accordion-open-body-1">
                        <span class="flex items-center">
                            <svg width="20" height="20" viewBox="0 0 29 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18.85 10.2936C19.943 10.2934 21.0068 9.93546 21.8832 9.27295C22.7597 8.61043 23.402 7.67871 23.7147 6.61628H27.55C27.9346 6.61628 28.3034 6.4613 28.5753 6.18545C28.8472 5.9096 29 5.53546 29 5.14534C29 4.75523 28.8472 4.38109 28.5753 4.10524C28.3034 3.82939 27.9346 3.67441 27.55 3.67441H23.7147C23.4015 2.61252 22.759 1.68145 21.8826 1.01949C21.0062 0.357531 19.9426 0 18.85 0C17.7573 0 16.6938 0.357531 15.8174 1.01949C14.941 1.68145 14.2985 2.61252 13.9853 3.67441H1.45C1.06544 3.67441 0.696623 3.82939 0.424695 4.10524C0.152767 4.38109 0 4.75523 0 5.14534C0 5.53546 0.152767 5.9096 0.424695 6.18545C0.696623 6.4613 1.06544 6.61628 1.45 6.61628H13.9853C14.298 7.67871 14.9403 8.61043 15.8168 9.27295C16.6932 9.93546 17.757 10.2934 18.85 10.2936ZM1.45 18.3837C1.06544 18.3837 0.696623 18.5387 0.424695 18.8145C0.152767 19.0904 0 19.4645 0 19.8547C0 20.2448 0.152767 20.6189 0.424695 20.8948C0.696623 21.1706 1.06544 21.3256 1.45 21.3256H4.56025C4.8735 22.3875 5.51604 23.3186 6.39244 23.9805C7.26884 24.6425 8.33235 25 9.425 25C10.5176 25 11.5812 24.6425 12.4576 23.9805C13.334 23.3186 13.9765 22.3875 14.2897 21.3256H27.55C27.9346 21.3256 28.3034 21.1706 28.5753 20.8948C28.8472 20.6189 29 20.2448 29 19.8547C29 19.4645 28.8472 19.0904 28.5753 18.8145C28.3034 18.5387 27.9346 18.3837 27.55 18.3837H14.2897C13.9765 17.3218 13.334 16.3908 12.4576 15.7288C11.5812 15.0668 10.5176 14.7093 9.425 14.7093C8.33235 14.7093 7.26884 15.0668 6.39244 15.7288C5.51604 16.3908 4.8735 17.3218 4.56025 18.3837H1.45Z" fill="#0C0C0C"/>
                            </svg>    
                            <p class="ml-4 mr-2 text-black">Filtro</p>

                            <svg width="28" height="18" viewBox="0 0 21 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.1798 25.1255L20.3904 12.2931C20.4607 12.1946 20.5 12.0689 20.5 11.9364V8.93041C20.5 8.67906 20.2416 8.56357 20.1067 8.75378L11.5674 20.6487L11.5674 0.771729C11.5674 0.622278 11.4663 0.5 11.3427 0.5L9.6573 0.5C9.53371 0.5 9.43258 0.622278 9.43258 0.771729L9.43258 20.6453L0.893259 8.75039C0.755619 8.56018 0.5 8.67566 0.5 8.92701V12.0349C0.5 12.0995 0.519663 12.164 0.556179 12.2115L9.82022 25.1255C9.90479 25.2431 10.0092 25.3374 10.1265 25.402C10.2438 25.4666 10.3711 25.5 10.5 25.5C10.6289 25.5 10.7562 25.4666 10.8735 25.402C10.9908 25.3374 11.0952 25.2431 11.1798 25.1255Z" fill="black"/>
                            </svg>
                        </span>
                            
                      </button>
                    </h2>
                    <div id="accordion-open-body-1" aria-labelledby="accordion-open-heading-1">
                        
                        <div class="rounded-lg">
                            <br>
                            <div>
                                <label class="text-sm" for="name">Nombre:</label>
                                <input wire:model='nombre' type="text"
                                    class="py-1 px-2 border border-slate-700 rounded w-full" name="search" id="search"
                                    placeholder="Nombre">
                            </div>
                            <br>
                            <p class="text-sm">Stock no disponible para productos de importación.</p>
                        </div> 
                    </div>
                    
                  </div>
               
            </div>
            <div class="w-full sm:w-full md:w-70 ml-10">
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
                                
                            
                                    <div class="w-full h-auto bg-white rounded-xl shadow-lg overflow-hidden p-4" style="border: 1px solid #d1d1d1;">
                                        <div
                                            class="flex sm:block gap-2 sm:bg-transparent bg-white rounded-md sm:rounded-none p-2 sm:p-0">
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
                                                <div class="py-2 text-lg text-slate-700">
                                                    <h5 class="capitalize m-0">
                                                        {{ Str::limit($row->name, 22, '...') }}</h5>
                                                    <p class="m-0">$
                                                        {{number_format($priceProduct,2)}}</p>
                                                </div>

                                                <style>
                                                    .pagination{

                                                        width: 300px;
                                                        display: flex;
                                                        justify-content: space-between;

                                                    }
                                                    .pagination .page-item.active {
                                                        background-color:#B1FE2E;
                                                        padding: 2px;
                                                        color: black; 
                                                    }
                                                </style>
                                                <a href="https://api.whatsapp.com/send?phone=5568096555&text=Hola%20me%20gustaría%20solicitar%20una%20cotización%20para%20el%20producto%20{{ $row->name }}%20con%20SKU%20:%20({{ $row->internal_sku }})"
                                                    class="block w-full bg-primary text-black hover:bg-black hover:text-white text-center rounded-sm font-semibold py-2 rounded-xl" target="__blank">
                                                    Solicitar cotización
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                

                            @endif
 
                        @endforeach
                    </div>
                </div>
                <div class=" flex sm:hidden justify-center">
                    {{ $products->onEachSide(0)->links() }}
                </div>
                <div class="hidden sm:flex justify-center">
                    {{ $products->onEachSide(3)->links() }}
                </div>
            </div>
        </div>

        <br>
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
