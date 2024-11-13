@extends('layouts.cotizador')
@section('title', $product->name)
@section('content')

    <!-- Detalle del producto -->
    <div class="container mx-auto py-6 px-6 w-[1000px] font-TCCCUnityHeadline">
        <!-- Contenedor principal del producto -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Sección izquierda: Imagen y thumbnails -->
            <div>
                <!-- Imagen principal del producto -->
                <div class="mb-4">
                    <img id="imgBox" class="py-4 rounded" src="{{ $product->firstImage ? $product->firstImage->image_url : asset('img/default.jpg') }}" alt="Producto" class="w-full h-auto rounded-lg shadow-md object-cover">
                </div>

                <!-- Thumbnails -->
                <div class="grid grid-cols-3 gap-2 mt-auto"> <!-- Grid con 3 columnas -->
                    @foreach ($product->images as $image)
                        <img src="{{ $image->image_url }}" alt="{{ $image->image_url }}"
                             onclick="cambiarImagen(this)"
                             class="w-20 h-20 rounded-lg shadow-md border border-black bg-white object-cover cursor-pointer">
                    @endforeach
                </div>
            </div>
            <!-- Sección derecha: Información del producto -->
            <div>
                <!-- Nombre del producto -->
                <h2 class="text-2xl capitalize font-light">{{ $product->name }}</h2>
                <!-- Descripción del producto -->
                <p class="text-base font-light text-primary capitalize mb-10">{{ $product->description }}</p>
                <!-- Precio unitario -->
                <p class="text-base font-light text-primary mb-3">Precio unitario: <span class="font-semibold">$ {{ $product->price }} MXN</span></p>

                <!-- Colores seleccionables -->
                <div class="mb-4 flex flex-row w-full items-center justify-start">
                    <h4 class="text-lg mb-1 font-light mr-6">Colores:</h4>
                    <div class="flex space-x-3">
                        <!-- Switch de color con borde al seleccionar -->
                        <button class="w-6 h-6 rounded-full bg-red-500 border-2 border-transparent focus:outline-none focus:border-black"></button>
                        <button class="w-6 h-6 rounded-full bg-blue-500 border-2 border-transparent focus:outline-none focus:border-black"></button>
                        <button class="w-6 h-6 rounded-full bg-green-500 border-2 border-transparent focus:outline-none focus:border-black"></button>
                    </div>
                </div>

                <!-- Cantidad y stock -->
                <div class="flex items-center">
                    {{-- <div class="mr-4">
                        <label for="quantity" class="block text-md font-semibold mb-1">Cantidad</label>
                        <input type="number" id="quantity" class="w-16 p-2 border border-gray-300 rounded-lg" value="1" min="1">
                    </div> --}}
                    <div class="self-center">
                        <p class="text-black font-light text-sm">Piezas disponibles: <span class="">{{ $product->stock }}</span></p>
                    </div>
                </div>

                <!-- Atributos del producto -->
                <div class="my-6">
                    <h4 class="text-lg font-semibold mb-1 text-[#939393] underline uppercase">Atributos</h4>
                    <ul class="space-y-1 text-sm text-[#939393] font-light list-disc list-inside">
                        @foreach ($product->productAttributes as $attr)
                            <li>{{ $attr->attribute }}:<span class="ml-2 font-semibold text-black">{{ $attr->value }}</span></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Personalizador y tecnicas -->
                <div class="flex flex-col space-y-3">
                    @livewire('formulario-de-cotizacion', ['product' => $product])
                </div>
            </div>
        </div>
    </div>
    {{-- TODO: Agregar compatiblidad con formulario livewire --}}
    <!-- Productos relacionados -->




    <div class="container mx-auto py-8 font-TCCCUnityHeadline">
        <h1 class="text-2xl font-bold mb-6 mt-10">Productos relacionados</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach ($recommendedProducts as $product)

                <div class="border border-gray-300 rounded-2xl shadow-lg p-4 bg-white">
                        @if ($product->firstImage)
                            <img src="{{ $product->firstImage->image_url }}" alt="Producto 1" class="w-full h-52 object-cover rounded-lg mb-4">
                        @else
                            <img src="{{asset('img/default.jpg')}}" class="w-full h-52 object-cover rounded-lg mb-4">
                        @endif
                    <h3 class="text-lg font-light text-primary mb-2 line-clamp-1 capitalize">{{ $product->name}}</h3>
                    <p class="text-md text-primary mb-4">$ {{ $product->price}}</p>
                    <button class="w-full flex items-center justify-center bg-primary text-white py-2 rounded-lg hover:bg-primary-light transition duration-300">
                        <svg width="23" height="23" viewBox="0 0 27 26" fill="none" xmlns="http://www.w3.org/2000/svg" class="mr-4">
                            <path d="M5.32664 12.2868C5.56683 14.4488 5.68693 15.5296 6.41437 16.1807C7.1418 16.8318 8.22936 16.8318 10.4045 16.8318H10.565H15.3736H17.1061C18.6046 16.8318 19.3537 16.8318 19.9617 16.4657C20.5697 16.0996 20.9203 15.4375 21.6214 14.1132L24.774 8.1584C25.4518 6.87797 24.5236 5.3363 23.0748 5.3363H10.565H10.2626C7.59855 5.3363 6.26655 5.3363 5.50499 6.18717C4.74342 7.03803 4.89053 8.36188 5.18472 11.0096L5.32664 12.2868Z" fill="#171616" stroke="white" stroke-width="2.5" stroke-linejoin="round"/>
                            <path d="M2 1.50452H2.63864C3.487 1.50452 4.19969 2.14241 4.29338 2.98558L5.26417 11.7227" fill="white"/>
                            <path d="M2 1.50452H2.63864C3.487 1.50452 4.19969 2.14241 4.29338 2.98558L5.26417 11.7227" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9.66367 22.5795C9.66367 23.6376 8.80589 24.4954 7.74776 24.4954C6.68963 24.4954 5.83185 23.6376 5.83185 22.5795C5.83185 21.5214 6.68963 20.6636 7.74776 20.6636C8.80589 20.6636 9.66367 21.5214 9.66367 22.5795Z" fill="white" stroke="white" stroke-width="2.5"/>
                            <path d="M21.1591 22.5795C21.1591 23.6376 20.3013 24.4954 19.2432 24.4954C18.1851 24.4954 17.3273 23.6376 17.3273 22.5795C17.3273 21.5214 18.1851 20.6636 19.2432 20.6636C20.3013 20.6636 21.1591 21.5214 21.1591 22.5795Z" fill="white" stroke="white" stroke-width="2.5"/>
                        </svg>
                        Agregar
                    </button>
                </div>
            @endforeach
        </div>
    </div>
    <style>
        #footerPrincipal{
            display: none;
        }
    </style>
    <!-- Footer -->
    <footer id="footerCatalogoByProduct" class="bg-primary text-white py-10 px-8">
        <!-- Logo en la esquina superior izquierda -->
        <div class="flex justify-start md:justify-between items-start mb-8">
            <div>
                <img src="{{asset('img/home/footerLogo.png')}}" alt="Logo" class="h-10">
            </div>
        </div>

        <hr class="border-white mb-8">

        <!-- Menú vertical y categorías, más juntas y responsivo -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Menú de enlaces -->
            <div class="flex flex-col space-y-2">
                <h4 class="text-lg font-bold mb-4">Menú</h4>
                <a href="#" class="hover:underline">Inicio</a>
                <a href="#" class="hover:underline">Catálogo</a>
                <a href="#" class="hover:underline">Importaciones</a>
                <a href="#" class="hover:underline">Mis Compras</a>
            </div>

            <!-- Categorías -->
            <div class="flex flex-col space-y-2">
                <h4 class="text-lg font-bold mb-4">Categorías</h4>
                <a href="#" class="hover:underline">Bebibles</a>
                <a href="#" class="hover:underline">Ropa</a>
                <a href="#" class="hover:underline">Ecológicos</a>
            </div>
        </div>

        <!-- Copyright y redes sociales responsivos -->
        <div class="flex flex-col md:flex-row justify-between items-center">
            <!-- Sello de copyright en la esquina inferior izquierda -->
            <div class="text-sm mb-6 md:mb-0">
                © 2024 The Coca‑Cola Company. Todos los derechos reservados.
            </div>

            <!-- Redes sociales y política de privacidad -->
            <div class="flex flex-col items-center space-y-4 md:space-y-0 md:flex-row md:space-x-6">
                <!-- Logos de redes sociales -->
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-primary">
                        <img src="/public/img/home/fb.svg" alt="Facebook" class="h-6 w-6">
                    </a>
                    <a href="#" class="hover:text-primary">
                        <img src="/public/img/home/twitter.svg" alt="Instagram" class="h-6 w-6">
                    </a>
                    <a href="#" class="hover:text-primary">
                        <img src="/public/img/home/insta.svg" alt="Twitter" class="h-6 w-6">
                    </a>
                    <a href="#" class="hover:text-primary">
                        <img src="/public/img/home/youtube.svg" alt="Twitter" class="h-6 w-6">
                    </a>
                </div>

                <!-- Política de privacidad debajo de redes sociales en pantallas pequeñas -->
                <a href="#" class="text-sm hover:underline md:mt-0">Política de privacidad</a>
            </div>
        </div>
    </footer>
    <script>
        function cambiarImagen(smallImg) {
            let fullImg = document.querySelector('#imgBox')
            console.log(fullImg);
            fullImg.src = smallImg.src
        }
    </script>
@endsection
