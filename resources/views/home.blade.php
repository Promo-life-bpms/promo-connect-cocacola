@extends('layouts.cotizador')

@section('content')

    <style>
        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .img1, .img2, .img3, .img4, .img4, .img5, .img6, .img7, .img8, .img9, .img10, .img11{
            width: 350px;
            height: 250px;
        }
        .img1:hover,
        .img2:hover,
        .img3:hover,
        .img4:hover,
        .img5:hover,
        .img6:hover,
        .img7:hover,
        .img8:hover,
        .img9:hover,
        .img10:hover,
        .img11:hover {
            background-size: cover;
            background-position: center;
            color: white;
        }

        .swiper-pagination-bullet-active{
            background: rgb(166 105 51);
        }
    </style>
    <div id="default-carousel" class="relative w-full text-center" data-carousel="slide"  style="margin-top: -12px;">
        <!-- Carousel wrapper -->
        <div class="relative overflow-hidden  md:h-[32rem] mx-auto w-full" style="max-height: 360px;">
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <a href="{{route('presentation')}}">
                    <img src="{{ asset('img/banner1.png') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..." style="z-index:1; object-fit: contain; !important">
                </a>
                
            </div>
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <a href="{{route('presentation')}}">
                    <img src="{{ asset('img/banner2.png') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..." style="z-index:1; object-fit: contain; !important">
                </a>
                
            </div>
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <a href="{{route('presentation')}}">
                    <img src="{{ asset('img/BANNER3.jpg') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..." style="z-index:1; object-fit: contain; !important">
                </a>
                
            </div>
            @foreach ($banners as $item)
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <a href="{{route('presentation')}}">
                        <img src="{{ asset('storage/banners/' . $item->url_banner) }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..." style="z-index:1; object-fit: contain; !important">
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Slider indicators -->
        <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
            @for ($i = 0; $i < count($banners); $i++)
                <button type="button" class="w-3 h-3 rounded-full" aria-current="{{ $i == 0 ? 'true' : 'false' }}"
                    aria-label="Slide {{ $i + 1 }}" data-carousel-slide-to="{{ $i }}"></button>
            @endfor
        </div>
        <!-- Slider controls -->
        <button type="button"
            class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="shadow-lg inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-slate-300/50 group-hover:bg-slate-300/70  group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                <svg aria-hidden="true" class=" w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button"
            class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="bg-slate-300/50 group-hover:bg-slate-300/70 shadow-lg inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg aria-hidden="true" class=" w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>

    </div>

    <a href="/presentation" type="button" class="absolute focus:outline-none text-black bg-primary hover:bg-black  hover:text-white  focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 z-30" style="margin-top: -100px; margin-left:46%;">Temporalidad</a>

    <!-- Premium  -->
    <section class="flex flex-col items-center justify-center w-full py-8 mx-auto">
        <h2 class="w-4/5 font-bold text-2xl text-left"><span class="text-4xl text-hh-green mb-2">Best Sellers</span><br /> Máxima Calidad</h2>
        <div class="w-full my-8 ">
        </div>
    </section>

    <div class="container mx-auto w-full py-8 bg-white" style="background-image: url('{{ asset('img/spiral.png') }}'); background-repeat: no-repeat; background-size: 100%; height:260px;">
        <div class="flex flex-wrap justify-center">
            @foreach ($latestProducts as $product)
                <a href="{{ route('show.product', ['product' => $product->id]) }}" class="flex items-center justify-center text-center overflow-hidden mx-4 group">
                    <img src="{{ isset($product->firstImage->image_url) ? $product->firstImage->image_url : asset('/img/default.jpg') }}" alt="" srcset="" class="max-h-40 w-auto overflow-hidden group-hover:scale-105 transition-transform duration-300">
                </a>
            @endforeach
        </div>
    </div>  

    <section class="flex flex-col items-center justify-center w-full py-8 mx-auto">
        <h2 class="w-4/5 font-bold text-hh-green text-4xl my-8">Categorias</h2>
    </section>

    <!-- Categorias -->
    <section class=" mx-auto flex flex-col items-center justify-center w-full px-2 px-20"> 
        <div class="grid grid-cols-5 sm:grid-cols-2 md:grid-cols-5 gap-4 ">
            <style>
                .hover-grow {
                    transition: transform 0.3s ease;
                }
            
                .hover-grow:hover {
                    transform: scale(1.05);
                }
            </style>
            
            <a href="{{ route('categoryfilter', ['category' => 9]) }}">
                <div class="max-w-sm bg-white rounded-lg shadow hover-grow" style="height: 220px;">
                    <img class="rounded-t-lg" src="{{ asset('img/categoria1.png') }}" alt="" />
                    <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold">Accesorios</h5>
                    </div>
                </div>
            </a>
            
            <a href="{{ route('categoryfilter', ['category' => 5]) }}">
                <div class="max-w-sm bg-white rounded-lg shadow hover-grow" style="height: 220px;">
                    <img class="rounded-t-lg" src="{{ asset('img/categoria2.png') }}" alt="" />
                    <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold">Textil</h5>
                    </div>
                </div>
            </a>
            
            <a href="{{ route('categoryfilter', ['category' => 7]) }}">
                <div class="max-w-sm bg-white rounded-lg shadow hover-grow" style="height: 220px;">
                    <img class="rounded-t-lg" src="{{ asset('img/categoria3.png') }}" alt="" />
                    <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold">Ecología</h5>
                    </div>
                </div>
            </a>
            
            <a href="{{ route('categoryfilter', ['category' => 14]) }}">
                <div class="max-w-sm bg-white rounded-lg shadow hover-grow" style="height: 220px;">
                    <img class="rounded-t-lg" src="{{ asset('img/categoria4.png') }}" alt="" />
                    <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold">Tecnología</h5>
                    </div>
                </div>
            </a>
            
            <a href="{{ route('categoryfilter', ['category' => 8]) }}">
                <div class="max-w-sm bg-white rounded-lg shadow hover-grow" style="height: 220px;">
                    <img class="rounded-t-lg" src="{{ asset('img/categoria5.png') }}" alt="" />
                    <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold">Hogar</h5>
                    </div>
                </div>
            </a>
            
        </div>
    </section>   

    <section class="container mx-auto max-w-7xl mt-20">
        <div class="flex">
            <div class="w-1/2 p-4">
                <img src="{{asset('img/persona.png')}}" alt="">
            </div>

            <div class="w-1/2 p-4" style="z-index: 40;">
                <div class="container mx-auto p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-center items-center">
                        @foreach ($moreProducts as $product)
                            @if ($product->firstImage)

                            <div class="flex-1 p-4 ">

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
                                        <p class="mb-2 text-lg font-bold" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $product->name}}</p>
                                        <p class="text-base text-stone-600 mb-2"> ${{ $product->price}}</p>
                                        
                                        <a href="{{ route('show.product', ['product' => $product->id]) }}" class="bg-black text-white font-semibold py-2 px-10 rounded mt-5">
                                            Ver más
                                        </a>
                                     
                                    </div>
                                </div>
                            </div>
    
                            @endif
                        @endforeach
                    </div>
                </div>
                
            </div>

            
        </div>
    </section>

    <section class="w-full mt-10" style="height:580px;">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4" style="z-index:20;">
            <div class="p-4" style="z-index:20;">
                <img src="{{ asset('img/manoderecha.png') }}" alt="mano" style="width:400px; float: left; margin-top: -160px; margin-left: -30px;">
            </div>
            <div class="p-4 bg-stone-100 text-center items-center" style="width: 260%; margin-left:-80%; z-index:0; height:560px;">
                
                <div style="background-image: url('{{asset('/img/espiral_vertical.png')}}'); background-size: contain; background-repeat: no-repeat; background-position: center; text-align: center; z-index:30; height:600px; margin-top:-40px;">
                    <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
                        <div style="padding-top: 14%;">
                            <h3 class="text-4xl font-bold">Termos</h3>
                            <br><br><br>
                            <p class="text-lg">Coleccionables de calidad que perduran en el tiempo.</p>
                        </div>
                         
                  
                    </div>
                    
                </div>
               
            </div>
            <div class="p-4" style="z-index:20;">
                <img src="{{asset('img/manoizquierda.png')}}" alt="mano" style="width:350px; float: right; margin-top: -160px; margin-right: -30px;">
            </div>
            
        </div>

    </section>


    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".mySwiper", {
          slidesPerView: 3,
          spaceBetween: 30,
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
        });
    </script>
  

@endsection
