@extends('layouts.cotizador')

@section('content')

    <style>
        .swiper {
            width: 100%;
            height: 100%;
        }

        [aria-current="true"] {
            background-color: black;
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
    <div id="default-carousel" class="container mx-auto mt-8 flex justify-center" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative overflow-hidden  md:h-[32rem] mx-auto w-full">
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <a href="{{route('presentation')}}">
                    <img class="w-full h-full object-fill" src="{{ asset('img/home/carouselImage.png') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="banner">
                </a>

            </div>
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <a href="{{route('presentation')}}">
                    <img class="w-full h-full object-fill" src="{{ asset('img/home/carouselImage.png') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </a>

            </div>
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <a href="{{route('presentation')}}">
                    <img class="w-full h-full object-fill" src="{{ asset('img/home/carouselImage.png') }}"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..." >
                </a>
            </div>
            @foreach ($banners as $item)
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <a href="{{route('presentation')}}">
                        <img class="w-full h-full object-fill" src="{{ asset('img/home/carouselImage.png') }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..." >
                    </a>
                </div>
            @endforeach
            <div class="absolute z-30 flex -translate-x-1/2 space-x-3 rtl:space-x-reverse bottom-5 left-1/2">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
            </div>
        </div>

        <!-- Slider indicators -->
        {{-- <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
            @for ($i = 0; $i < count($banners); $i++)
                <button type="button" class="w-3 h-3 rounded-full" aria-current="{{ $i == 0 ? 'true' : 'false' }}"
                    aria-label="Slide {{ $i + 1 }}" data-carousel-slide-to="{{ $i }}"></button>
            @endfor
        </div> --}}

    </div>

    <!-- Los Favoritos -->
    <div class="w-full mt-10 p-6 sm:p-10 md:p-24 bg-cover bg-center relative" style="background-image:  url('{{ asset('img/home/favoritosBackground.png') }}');">
        <!-- Título "Los favoritos" en la esquina superior derecha -->
        <h2 class="text-xl sm:text-2xl md:text-3xl font-TCCCUnityHeadline font-bold text-primary absolute top-4">LOS FAVORITOS</h2>

        <!-- Contenedor de imágenes horizontales -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 relative top-16 overflow-hidden">
            <!-- Imagen 1 -->
            @foreach ( array_slice($latestProducts, 0, 4) as $product )
            <div class="w-full h-52 sm:h-60 md:h-[234px] rounded-lg overflow-hidden transform transition-transform duration-300 hover:scale-105">
                <a href="{{ route('show.product', ['product' => $product->id]) }}">
                    <img
                        src="{{ isset($product->firstImage->image_url) ? $product->firstImage->image_url : asset('/img/default.jpg') }}"
                        alt="Favorito 1"
                        class="w-full h-full object-contain">
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Categorías -->
    <div class="w-full mt-10 p-6 sm:p-10 md:p-24 bg-cover bg-center relative">
        <h2 class="text-xl sm:text-2xl md:text-3xl font-TCCCUnityHeadline font-bold text-primary absolute top-4">CATEGORÍAS</h2>

        <!-- Contenedor de categorías responsivas -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4 mt-8">
            <!-- Categoría 1 -->
            <div class="flex flex-col items-center transition-transform duration-300 hover:scale-105 cursor-pointer">
                <a href="{{ route('categoryfilter', ['category' => 9]) }}">
                    <div class="w-[180px] h-[180px] bg-secondary flex items-center justify-center rounded-[30px] hover:bg-black">
                        <svg width="118" height="121" viewBox="0 0 118 121" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M74.7164 25.8956V22.1583H76.5503C80.6213 22.1583 83.9331 18.7625 83.9331 14.588C83.9331 10.4138 80.6213 7.01775 76.5503 7.01775H74.4131C73.3751 2.98364 69.7872 0 65.5313 0H52.4684C47.4039 0 43.2833 4.22507 43.2833 9.4186V25.8958C38.0648 26.7587 34.0669 31.4096 34.0669 37.0002V109.752C34.0669 115.954 38.9876 121 45.0358 121H72.964C79.0124 121 83.9329 115.954 83.9329 109.752V37.0002C83.9329 31.4094 79.9349 26.7584 74.7164 25.8956ZM74.7162 10.6118H76.55C78.6886 10.6118 80.4279 12.3954 80.4279 14.588C80.4279 16.7804 78.6886 18.5642 76.55 18.5642H74.7162V10.6118ZM46.7883 9.4186C46.7883 6.20691 49.3366 3.59407 52.4684 3.59407H65.5316C68.5224 3.59407 70.9789 5.97744 71.1944 8.98896L71.1951 8.99912C71.1983 9.04757 71.2018 9.09602 71.2048 9.14446C71.2089 9.23545 71.2115 9.32667 71.2115 9.4186V18.5642H46.7883V9.4186ZM74.7164 117.191V113.572H71.2115V117.406H67.7344V113.572H64.2294V117.406H60.7524V113.572H57.2474V117.406H53.7703V113.572H50.2654V117.406H46.7883V113.572H43.2833V117.191C40.0109 116.38 37.5719 113.353 37.5719 109.752V37.0002C37.5719 32.7801 40.9203 29.3465 45.0358 29.3465H46.7883H53.7226V25.7524H46.7883V22.1583H71.2115V25.7524H58.3958V29.3465H71.2115H72.964C77.0794 29.3465 80.4279 32.7801 80.4279 37.0002V109.752C80.4277 113.354 77.9889 116.38 74.7164 117.191Z" fill="white"/>
                            <path d="M72.9639 32.9405H65.075V36.5346H72.9639C72.9748 36.5346 72.9835 36.5351 72.9907 36.5355C73.066 36.6296 73.418 37.1675 73.418 38.9912V77.1785H76.9229V38.991C76.9229 37.1148 76.6247 35.7112 76.0117 34.7005C75.3228 33.5654 74.2407 32.9405 72.9639 32.9405Z" fill="white"/>
                        </svg>
                    </div>
                </a>
                <p class="text-center text-[15px] font-TCCCUnityHeadline font-normal text-secondary mt-4">BEBIDAS</p>
            </div>

            <div class="flex flex-col items-center transition-transform duration-300 hover:scale-105 cursor-pointer">
                <a href="{{ route('categoryfilter', ['category' => 5]) }}">
                    <div class="w-[180px] h-[180px] bg-secondary flex items-center justify-center rounded-[30px] hover:bg-black">
                        <svg width="110" height="110" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M103.125 22.3438H82.5V6.875C82.5 3.07484 79.4252 0 75.625 0H34.375C30.5748 0 27.5 3.07484 27.5 6.875V22.3438H6.875C3.07484 22.3438 0 25.4186 0 29.2188V103.125C0 106.925 3.07484 110 6.875 110H103.125C106.925 110 110 106.925 110 103.125V29.2188C110 25.4186 106.925 22.3438 103.125 22.3438ZM30.9375 6.875C30.9375 4.9775 32.4775 3.4375 34.375 3.4375H75.625C77.5225 3.4375 79.0625 4.9775 79.0625 6.875V22.3438H75.625V8.59375C75.625 7.64328 74.8567 6.875 73.9062 6.875H36.0938C35.1433 6.875 34.375 7.64328 34.375 8.59375V22.3438H30.9375V6.875ZM72.1875 10.3125V22.3438H37.8125V10.3125H72.1875ZM106.562 103.125C106.562 105.022 105.022 106.562 103.125 106.562H6.875C4.9775 106.562 3.4375 105.022 3.4375 103.125V72.1875H20.625V80.7812C20.625 81.7317 21.3933 82.5 22.3438 82.5H32.6562C33.6067 82.5 34.375 81.7317 34.375 80.7812V72.1875H75.625V80.7812C75.625 81.7317 76.3933 82.5 77.3438 82.5H87.6562C88.6067 82.5 89.375 81.7317 89.375 80.7812V72.1875H106.562V103.125ZM24.0625 79.0625V61.875H30.9375V79.0625H24.0625ZM79.0625 79.0625V61.875H85.9375V79.0625H79.0625ZM106.562 68.75H89.375V60.1562C89.375 59.2058 88.6067 58.4375 87.6562 58.4375H77.3438C76.3933 58.4375 75.625 59.2058 75.625 60.1562V68.75H34.375V60.1562C34.375 59.2058 33.6067 58.4375 32.6562 58.4375H22.3438C21.3933 58.4375 20.625 59.2058 20.625 60.1562V68.75H3.4375V29.2188C3.4375 27.3212 4.9775 25.7812 6.875 25.7812H103.125C105.022 25.7812 106.562 27.3212 106.562 29.2188V68.75Z" fill="#F9F9F9"/>
                        </svg>
                    </div>
                </a>
                <p class="text-center text-[15px] font-TCCCUnityHeadline font-normal text-secondary mt-4">OFICINA</p>
            </div>

            <div class="flex flex-col items-center transition-transform duration-300 hover:scale-105 cursor-pointer">
                <a href="{{ route('categoryfilter', ['category' => 7]) }}">
                    <div class="w-[180px] h-[180px] bg-secondary flex items-center justify-center rounded-[30px] hover:bg-black">
                        <svg width="114" height="114" viewBox="0 0 114 114" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M38.9103 16.1775H15.7066V19.6581H38.9103V16.1775Z" fill="white"/>
                            <path d="M54.6886 8.75262H51.208V12.2332H54.6886V8.75262Z" fill="white"/>
                            <path d="M60.2575 8.75262H56.5449V12.2332H60.2575V8.75262Z" fill="white"/>
                            <path d="M65.5943 8.75262H62.1138V12.2332H65.5943V8.75262Z" fill="white"/>
                            <path d="M22.8998 23.1387H15.7066V26.6192H22.8998V23.1387Z" fill="white"/>
                            <path d="M35.1977 33.8123H15.7066V37.2929H35.1977V33.8123Z" fill="white"/>
                            <path d="M49.584 33.8123H38.9103V37.2929H49.584V33.8123Z" fill="white"/>
                            <path d="M42.3909 41.0055H15.7066V44.4861H42.3909V41.0055Z" fill="white"/>
                            <path d="M58.6332 41.0055H45.8712V44.4861H58.6332V41.0055Z" fill="white"/>
                            <path d="M22.8998 48.1986H15.7066V51.6792H22.8998V48.1986Z" fill="white"/>
                            <path d="M51.2083 48.1986H26.3803V51.6792H51.2083V48.1986Z" fill="white"/>
                            <path d="M58.6334 55.1597H15.7066V58.6403H58.6334V55.1597Z" fill="white"/>
                            <path d="M31.7172 62.3529H15.7066V65.8334H31.7172V62.3529Z" fill="white"/>
                            <path d="M38.9101 62.3529H35.1975V65.8334H38.9101V62.3529Z" fill="white"/>
                            <path d="M51.2083 69.546H15.7066V73.0266H51.2083V69.546Z" fill="white"/>
                            <path d="M28.0046 89.0371H15.7066V92.5177H28.0046V89.0371Z" fill="white"/>
                            <path d="M24.524 76.5071H15.7066V79.9877H24.524V76.5071Z" fill="white"/>
                            <path d="M111.026 29.7092C108.95 27.6336 105.573 27.6339 103.498 29.709L102.221 30.9853L98.4412 27.2052L84.5969 41.0498L87.0851 43.5377L98.4412 32.1814L108.538 42.2777L111.026 39.7898L109.749 38.5135L111.026 37.2372C113.101 35.1616 113.101 31.7846 111.026 29.7092ZM108.537 34.7491L107.261 36.0253L104.709 33.4732L105.985 32.197C106.689 31.4934 107.834 31.4934 108.537 32.197C109.241 32.9008 109.241 34.0455 108.537 34.7491Z" fill="white"/>
                            <path d="M105.97 42.2936L98.4412 34.7653L79.5406 53.6659L78.2806 52.4059L74.4329 56.2537V0H1.41788V114H74.4331V76.3497L88.3288 62.454L87.0688 61.194L105.97 42.2936ZM70.9147 110.482H4.93651V3.51841H70.9145V59.7721L60.6723 70.0143L61.9323 71.2743L59.2729 73.9337L53.336 82.8388L54.3718 83.8746L51.8355 86.4107L54.3237 88.8986L56.8597 86.3626L57.8958 87.3986L66.8009 81.4619L69.4603 78.8025L70.7205 80.0627L70.9145 79.8688L70.9147 110.482ZM64.4202 73.762L66.9723 76.3141L64.5594 78.727L58.3442 82.8707L57.8637 82.3902L62.0071 76.1752L64.4202 73.762ZM70.9875 74.8196H70.9145V74.8924L70.7205 75.0864L65.648 70.0143L78.2806 57.3816L83.3529 62.454L70.9875 74.8196ZM82.0286 56.1537L98.4412 39.741L100.993 42.2931L84.5807 58.7058L82.0286 56.1537Z" fill="white"/>
                            <path d="M50.8081 87.4832L48.8915 89.0373H40.7672V92.5179H50.125L53.0004 90.1867L50.8081 87.4832Z" fill="white"/>
                        </svg>
                    </div>
                </a>
                <p class="text-center text-[15px] font-TCCCUnityHeadline font-normal text-secondary mt-4">ESCRITURA</p>
            </div>

            <div class="flex flex-col items-center transition-transform duration-300 hover:scale-105 cursor-pointer">
                <a href="{{ route('categoryfilter', ['category' => 14]) }}">
                    <div class="w-[180px] h-[180px] bg-secondary flex items-center justify-center rounded-[30px] hover:bg-black">
                        <svg width="110" height="117" viewBox="0 0 110 117" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M62.639 78H47.361V66.6252H36.6667V50.3748H47.361V39H62.639V50.3748H73.3333V66.6252H62.639V78Z" stroke="white" stroke-width="3.75" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M22.9167 87.75L14.3475 23.9486C14.0088 21.4268 15.5553 19.0733 17.8932 18.5207L53.0113 10.22C54.3212 9.91043 55.6788 9.91043 56.9887 10.22L92.1067 18.5207C94.4446 19.0733 95.9911 21.4268 95.6523 23.9485L87.0833 87.75C86.7593 90.1631 84.7917 104.813 55 104.813C25.2083 104.813 23.2408 90.1631 22.9167 87.75Z" stroke="white" stroke-width="3.75" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </a>
                <p class="text-center text-[15px] font-TCCCUnityHeadline font-normal text-secondary mt-4">SALUD</p>
            </div>

            <div class="flex flex-col items-center transition-transform duration-300 hover:scale-105 cursor-pointer">
                <a href="{{ route('categoryfilter', ['category' => 8]) }}">
                    <div class="w-[180px] h-[180px] bg-secondary flex items-center justify-center rounded-[30px] hover:bg-black">
                        <svg width="102" height="102" viewBox="0 0 102 102" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.44 58.5768V36.7488C22.44 36.1853 22.8965 35.7288 23.46 35.7288H37.74C38.3035 35.7288 38.76 36.1853 38.76 36.7488V58.5768C38.76 59.7035 39.6733 60.6168 40.8 60.6168C41.9267 60.6168 42.84 59.7035 42.84 58.5768V36.7488C42.84 33.932 40.5567 31.6488 37.74 31.6488H23.46C20.6432 31.6488 18.36 33.932 18.36 36.7488V58.5768C18.36 59.7035 19.2733 60.6168 20.4 60.6168C21.5267 60.6168 22.44 59.7035 22.44 58.5768ZM80.0873 46.9491L81.1077 32.6691H65.8086L66.829 46.9491H80.0873ZM84.0579 48.6255C83.9594 49.9735 82.8267 51.0291 81.4763 51.0291H65.4399C64.0886 51.0291 62.9516 49.9711 62.8583 48.6255L61.6192 31.2855C61.5125 29.8228 62.6626 28.5891 64.1271 28.5891H82.789C84.2536 28.5891 85.4037 29.8229 85.2971 31.2824L84.0579 48.6255Z" fill="white"/>
                            <path d="M41.82 97.8468C42.3835 97.8468 42.84 97.3903 42.84 96.8268V63.1668C42.84 62.6033 42.3835 62.1468 41.82 62.1468H20.4C19.2735 62.1468 18.36 63.0603 18.36 64.1868V96.8268C18.36 97.3903 18.8165 97.8468 19.38 97.8468H41.82ZM41.82 101.927H19.38C16.5632 101.927 14.28 99.6435 14.28 96.8268V64.1868C14.28 60.8069 17.0202 58.0668 20.4 58.0668H41.82C44.6367 58.0668 46.92 60.35 46.92 63.1668V96.8268C46.92 99.6435 44.6367 101.927 41.82 101.927ZM79.968 48.9888V95.8068C79.968 96.9333 79.0545 97.8468 77.928 97.8468H68.952C67.8255 97.8468 66.912 96.9333 66.912 95.8068V47.9688C66.912 46.8421 65.9987 45.9288 64.872 45.9288C63.7453 45.9288 62.832 46.8421 62.832 47.9688V95.8068C62.832 99.1866 65.5722 101.927 68.952 101.927H77.928C81.3078 101.927 84.048 99.1866 84.048 95.8068V48.9888C84.048 47.8621 83.1347 46.9488 82.008 46.9488C80.8813 46.9488 79.968 47.8621 79.968 48.9888ZM33.66 33.6888H37.74V3.90479C37.74 0.636504 34.8296 -1.01143 32.0274 0.669176L27.0738 3.64172C25.0172 4.87518 23.4601 7.6253 23.4601 10.0248V33.6888H27.5401V10.0248C27.5401 9.05858 28.345 7.63675 29.1727 7.1404L33.6601 4.44766L33.66 33.6888ZM62.3628 4.10879H84.5211L81.2068 31.4029C81.0711 32.5213 81.8676 33.5381 82.9861 33.6738C84.1045 33.8096 85.1213 33.013 85.2571 31.8946L88.7399 3.2121V3.08869C88.7399 1.39901 87.3696 0.0286875 85.6799 0.0286875H61.1999C59.5102 0.0286875 58.1399 1.39901 58.1399 3.08869V3.21529L61.7255 32.0029C61.8648 33.1209 62.884 33.9144 64.002 33.7751C65.12 33.6359 65.9135 32.6167 65.7743 31.4987L62.3628 4.10879Z" fill="white"/>
                        </svg>
                    </div>
                </a>
                <p class="text-center text-[15px] font-TCCCUnityHeadline font-normal text-secondary mt-4">CUIDADO PERSONAL</p>
            </div>

            <div class="flex flex-col items-center transition-transform duration-300 hover:scale-105 cursor-pointer">
                <a href="{{ route('categoryfilter', ['category' => 8]) }}">
                    <div class="w-[180px] h-[180px] bg-secondary flex items-center justify-center rounded-[30px] hover:bg-black">
                        <svg width="112" height="112" viewBox="0 0 112 112" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M39.2 16.8L28 28H5.6L0 33.6V89.6L5.6 95.2H34.6719C32.2874 93.6163 30.1152 91.7344 28.2078 89.6H8.4L5.6 86.8V36.4L8.4 33.6H30.3188L41.5187 22.4H64.8813L76.0813 33.6H103.6L106.4 36.4V86.8L103.6 89.6H78.2031C76.2958 91.7344 74.1235 93.6163 71.7391 95.2H106.4L112 89.6V33.6L106.4 28H78.4L67.2 16.8H39.2ZM53.2 33.6C36.1896 33.6 22.4 47.3896 22.4 64.4C22.4 81.4104 36.1896 95.2 53.2 95.2C70.2104 95.2 84 81.4104 84 64.4C84 47.3896 70.2104 33.6 53.2 33.6ZM53.2 39.2C67.1176 39.2 78.4 50.4824 78.4 64.4C78.4 78.3176 67.1176 89.6 53.2 89.6C39.2824 89.6 28 78.3176 28 64.4C28 50.4824 39.2824 39.2 53.2 39.2ZM89.6 39.2V44.8H100.8V39.2H89.6Z" fill="white"/>
                        </svg>
                    </div>
                </a>
                <p class="text-center text-[15px] font-TCCCUnityHeadline font-normal text-secondary mt-4">TECNOLOGÍA</p>
            </div>

        </div>
    </div>

    <!-- Sección completa con imagen y productos -->
    <div class="container mx-auto mt-10 p-6 sm:p-10 md:p-24">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Parte izquierda: Imagen -->
            <div class="w-full md:w-1/2 flex justify-center items-center">
                <img src="{{asset('img/home/productsLeft.png')}}" alt="Imagen Izquierda" class="w-full h-auto object-cover rounded-lg">
            </div>

            <!-- Parte derecha: Grid de productos -->
            <div class="w-full md:w-1/2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Producto 1 -->
                @foreach (array_slice($latestProducts, 0, 4) as $product)
                    @if ($product->firstImage)
                        <div class="border border-gray-300 rounded-2xl shadow-lg p-4 bg-white">
                            <img src="{{ $product->firstImage->image_url }}" alt="Producto 1" class="w-full h-auto object-cover rounded-lg mb-4 max-h-64">
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
                    @else
                        <div class="border border-gray-300 rounded-2xl shadow-lg p-4">
                            <img src="{{asset('img/hh-logo.png')}}" alt="Producto 1" class="w-full h-auto object-cover rounded-lg mb-4">
                            <h3 class="text-lg font-bold text-primary mb-2 text-center font-TCCCUnityHeadline">{{ strtolower($product->name) }}</h3>
                            <p class="text-md text-primary mb-4 font-TCCCUnityHeadline font-bold">${{ $product->price}}</p>
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
                @endforeach

            </div>
        </div>
    </div>

    <!-- Card centrado con dimensiones exactas y contenido centrado -->
    <div class="flex justify-center items-center w-full mt-10">
        <div class="bg-white p-8 rounded-2xl shadow-lg" style="width: 1329px; height: 586px;">
            <!-- Contenido centrado -->
            <div class="flex flex-col justify-center items-center h-full">
                <!-- Título centrado -->
                <h2 class="md:text-3xl text-6xl font-bold text-primary mb-4 font-TCCCUnityHeadline">TERMOS</h2>

                <!-- Texto descriptivo centrado -->
                <p class="text-md md:text-lg text-primary-dark mb-6 font-TCCCUnityHeadline" >Coleccionables de calidad que perduran con el tiempo</p>

                <!-- Botón rojo centrado -->
                <button class="bg-secondary text-white py-2 px-6 rounded-lg hover:bg-secondary-light transition duration-300 font-TCCCUnityHeadline">
                    VER MÁS
                </button>
            </div>
        </div>
    </div>

    <!-- Premium brands -->
    <div class="w-full mt-10">
        <img src="{{ asset('img/home/premiumBrands.png')}}" alt="Imagen Ancho Completo" class="w-full h-96 max-h-screen object-fill">
    </div>
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
