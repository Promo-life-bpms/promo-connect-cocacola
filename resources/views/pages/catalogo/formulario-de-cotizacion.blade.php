<div>
  

    <ol class="relative text-gray-500 border-s border-stone-50 ">                  
        <li class="mb-10 ms-6">            
            <span class="absolute flex items-center justify-center w-8 h-8 bg-white rounded-full -start-4 ring-4 ring-white">
                1
            </span>
           <div>
                <p class="text-lg font-bold mb-2">Número de proyecto</p>
                <input type="text" name="projecName" id="add-to-car" placeholder="Ingresa el número de proyecto" wire:model="projecName" required class="w-full">
           </div>
        </li>
     
        @if (!empty($projecName))
        <li class="mb-10 ms-6">
            <span class="absolute flex items-center justify-center w-8 h-8 bg-white rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                2
            </span>
    
            <p class="flex flex-grow text-lg grid-cols-1 mt-2"><strong>Personalizacion de la tecnica</strong></p>

               
    <div class="">
        <div class="rounded">
            <div class="grid grid-cols-2">
                <div class="m-0 mb-1 col-span-1">
                    <label for="tecnica" class="m-0"><strong>Material</strong> </label>
                    <select name="" id=""
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-slate-500 focus:border-slate-500 block w-full p-2.5"
                        wire:model="materialSeleccionado" wire:change="resetTecnique">
                        <option value="">Seleccione el material</option>
                        @foreach ($materiales as $material)
                            <option value="{{ $material->id }}">{{ $material->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                @if ($techniquesAvailables)
                    <div class="form-group m-0 mb-1 col-md-6">
                        <label for="tecnica" class="m-0"><strong>Tecnica</strong> </label>
                        <select name="" id=""
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-slate-500 focus:border-slate-500 block w-full p-2.5"
                            wire:model="tecnicaSeleccionada" wire:change="resetSizes">
                            <option value="">Seleccione la tecnica</option>
                            @foreach ($techniquesAvailables as $technique)
                                <option value="{{ $technique->id }}">{{ $technique->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
                @if ($sizesAvailables)
                    <div class="form-group m-0 mb-1 col-md-6">
                        <label for="tecnica" class="m-0"><strong>Tamaño</strong> </label>
                        <select name="" id=""
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-slate-500 focus:border-slate-500 block w-full p-2.5"
                            wire:model="sizeSeleccionado">
                            <option value="">Seleccione el tamaño</option>
                            @foreach ($sizesAvailables as $size)
                                <option value="{{ $size->id }}">{{ $size->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                @if ($preciosDisponibles)
                    <div class="col-span-2">
                        <p class="m-1"><strong> Precios Por Cantidad de Articulos, de acuerdo al material,
                                tecnica y tamaño seleccionados</strong></p>
                        <table class="w-full text-sm text-left text-gray-500 ">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <td class="px-6 py-3"><strong>Escala</strong></td>
                                    <td class="px-6 py-3"><strong>Precio</strong></td>
                                    <td class="px-6 py-3"><strong>Tipo de precio</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($preciosDisponibles as $item)
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $item->escala_inicial }} - {{ $item->escala_final }}
                                        </td>
                                        <td class="px-6 py-4">{{ $item->precio }}</td>
                                        <td class="px-6 py-4">
                                            {{ $item->tipo_precio == 'F' ? 'Precio por Articulo' : 'Precio Fijo' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="grid grid-cols-1 md:grid-cols-3 mt-5">
                <label><strong>Piezas</strong> </label>
                <br>
                <input
                    class="grid grid-cols-3  w-full py-2 text-center rounded-lg ring-1 ring-inset placeholder:text-gray-300"
                    type="number" name="cantidad" wire:model="cantidad" placeholder="Piezas" min="0"
                    max="{{ $product->stock }}">
            </div>
            <br>
            <div class="grid grid-cols-1 md:grid-cols-3">
                <label class="col-span-2"><strong>Cantidad de Colores y / o Logos</strong> </label>
                <input
                    class="flex flex-wrap w-full py-2 text-center rounded-lg ring-1 ring-inset placeholder:text-gray-300"type="number"
                    name="colores" wire:model="colores" placeholder="Colores" min="0">
            </div>
            <br>

            <div wire:ignore id="modalPersonalize" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative  bg-stone-50 rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold ">
                                Personalizar producto
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="modalPersonalize">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                            <div class="flex">
                                
                                <div class="flex-initial">
                                    <canvas  wire:ignore id="canvas" width="400" height="400" crossorigin="anonymous" ></canvas> 
                                    <p class="mt-2 text-sm text-semibold text-red-800"><b>Nota: </b>Imagen solo de referencia *</p>
                                </div>
                                <div class="flex-initial pl-4">
                            
                                    <p class="text-base font-bold">Selecciona tu logo </p>

                                    <div class="grid grid-cols-3 gap-4">
                                        <select id="logos" name="logos" class=" mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" style="width: 210px;">
                                            <option value="HHGLOBALNEGRO.png">HH Global negro</option>
                                            <option value="HHGLOBALBLANCO.png">HH Global blanco</option>
                                            <option value="LOGOADARENEGRO.png">Adare negro</option>
                                            <option value="LOGOADAREBLANCO.png">Adare blanco</option>
                                        </select>
                                    </div>
                                    
                                    <br>
                                    
                                   {{--  <input type="file"
                                        class="block w-full text-sm text-slate-500 bg-violet-50
                                            file:rounded-full
                                            file:mr-4 file:py-2 file:px-4
                                            file:text-sm file:font-semibold mt-2"
                                        wire:model="photo" accept="image/*" id="imageInput" > --}}
                                        
                                        <p class="inline-block cursor-pointer transition duration-300 ease-in-out text-stone-700 " id="clearImage" style="display:none;">Limpiar imagen</p>
                                        
                                      
                                        <p class="text-base font-bold">Texto  (opcional) </p>
                                        <!-- <p class="text-sm mb-2">Coloca tu logo en la posicion deseada y descarga el producto personalizado</p>
                                        <button id="showGeneratedImage" class="favorite styled flex items-center gap-2 bg-green-600 hover:bg-lime-600 text-white py-2 px-4 rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                                            </svg>
                                            Descargar
                                        </button> -->
                                        <div class="flex">
                                            <div class="flex-initial w-6/8 ">
                                                <input class="w-full" type="text" id="textInput" placeholder="Ingresa texto">
                                            </div>
                                            <div class="flex-initial w-2/8 ">
                                                <button  class="w-full bg-stone-900 hover:bg-black hover:bg-white text-white py-2 px-4 rounded"  id="addTextButton">Agregar</button>
                                            </div>
                                        </div>
                                        <p class="inline-block cursor-pointer transition duration-300 ease-in-out text-stone-700 " id="clearText" style="display:none;">Limpiar texto</p>
                                        <br>
                                        <p class="text-base font-bold">Color de texto (opcional) </p>
                                        <input type="color" id="colorPicker" name="colorPicker" value="#ff0000">
                                        <p class="mt-4"></p>
                                        <!-- <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                            x-on:livewire-upload-finish="isUploading = false"
                                            x-on:livewire-upload-error="isUploading = false"
                                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                                            <input type="file"
                                                class="block w-full text-sm text-slate-500 bg-violet-50
                                                file:rounded-full
                                                file:mr-4 file:py-2 file:px-4
                                                file:text-sm file:font-semibold"
                                                wire:model="photo" accept="image/*" onchange="fileUploaded()" id="fileInput">
                                                <div class="text-xs m-1" id="statusIcon"></div> -->

                                        <button class="w-full bg-primary hover:bg-primary hover:bg-text text-black py-2 px-4 rounded" id="sendImageToBackend">GUARDAR</button>
                                        <p class="inline-block cursor-pointer transition duration-300 ease-in-out text-green-600 text-sm" id="savedText" style="display:none;">Imagen guardada, ya puedes cerrar esta ventana</p>
                                        <p class="inline-block cursor-pointer transition duration-300 ease-in-out text-red-600 text-sm" id="errorText" style="display:none;">Ocurrio un error al guardar la imagen, intenta nuevamente</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


        </li>
        <li class="ms-6">
            <span class="absolute flex items-center justify-center w-8 h-8 bg-gray-100 rounded-full -start-4 ring-4 ring-white dark:ring-gray-900 dark:bg-gray-700">
                3
            </span>

            <p class="flex flex-grow text-lg grid-cols-1 mt-2"><strong>Total</strong></p>

            <div class="rounded">
                <div class="form-group m-0 mb-1 ">
                    <label for="newTechnique" class=" m-0">
                        <strong>Dias de entrega:</strong>
                        10
                    </label>
                </div>
                <div class="form-group m-0 mb-1 ">
                    <label for="newTechnique" class=" m-0">
                        <strong>
                            Precio actual de la tecnica por articulo:
                        </strong>
                        $ {{ $precioDeTecnica * $colores }}
                    </label>
                </div>
            </div>
          
            <div class="justify-content-between  grid grid-cols-1">
                {{--  @if (!$priceScales) --}}
                <div>
                    <h6 class="text-success"><strong>Precio Final por Articulo:</strong> $ {{ number_format($costoCalculado,2)}}</h6>
                    <h6 class="text-success"><strong>Precio Total:</strong> $ {{ number_format($costoTotal,2)}}</h6>
                </div>
        
                {{--  @endif --}}
                <div class="form-group m-0 mb-1 text-center">
                    @if ($currentQuote)
                        <button type="button" class="btn btn-warning py-2 px-4" wire:click='editarCurrentCotizacion'>Editar
                            cotizacion</button>
                    @elseif ($productEdit)
                        <button type="button" class="btn btn-info py-2 px-4" wire:click='editarCotizacion'>Actualizar
                            cotizacion</button>
                    @elseif ($productNewAdd)
                        <button type="button" class="btn btn-secondary py-2 px-4" wire:click='addNewProductToQuote'>Agregar
                            a
                            la cotizacion</button>
                    @else
                    @endif
                </div>
                
                <button data-modal-hide="add-to-car" type="submit" class="bg-primary hover:bg-black hover:text-white text-black py-3 col-span-4 px-10" wire:click="agregarCarrito()"> 
                    Agregar al carrito
                </button>
                @if ($errors)
                    <div wire:poll.12s>
                        @if ($errors->has('cantidad'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">No se ha colocado la cantidad de productos</span>
                            </div>
                        @endif
                        @if ($errors->has('colores'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">No se ha colocado la cantidad de colores</span>
                            </div>
                        @endif
                        @if ($errors->has('projecName'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">No se ha colocado el número de proyecto</span>
                            </div>
                        @endif
                    </div>
                    @php
                        $errors = null;
                    @endphp
                @endif
             
              
                @if (session()->has('message'))
                    <div wire:poll.4s class="btn btn-sm btn-success w-100" style="margin-top:0px; margin-bottom:0px;">
                        {{ session('message') }} </div>
                @endif

        </li>
        @endif
    </ol>


    @if (!empty($projecName))


    


 
    </div>

    <style>
        .img-select:hover {
            background-color: rgb(177, 191, 250);
        }

        .img-select.selected {
            background-color: rgb(177, 191, 250);
        }

        .img-select {
            padding: 10px;
            margin: 0 10px;
            border-radius: 10px;
            background-color: rgb(251, 251, 254);
        }
    </style>
    <script src="{{ asset('js/fabric.js') }}"></script>
    <script src="{{ asset('js/html2canvas.js') }}"></script>
    <script>
        function modalLogo() {
            let modal = document.querySelector('#modalOpenLogo')
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeModalLogo() {
            let modal = document.querySelector('#modalOpenLogo')
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
        window.addEventListener('addProducto', event => {
            Swal.fire({
                icon: "success",
                title: "Se ha guardado la cotizacion",
                showConfirmButton: false,
                timer: 3000
            })
        })

        /* Generador de logos  */

       /*  Obtener de path de imagenes */
        var imageURL = "{{ $product->images != '[]'?  $product->images[0]->image_url : '' }}";
        var productID = "{{ $product->id }}";

        /* Logos */
                                            
        var logo1 = "{{asset('img/HHGLOBALNEGRO.png')}}";
        var logo2 = "{{asset('img/HHGLOBALBLANCO.png')}}";
        var logo3 = "{{asset('img/LOGOADARENEGRO.png')}}";
        var logo4 = "{{asset('img/LOGOADAREBLANCO.png')}}";

        if(imageURL.startsWith("https://catalogodeproductos.promolife.lat/")){
            imageURL = imageURL.slice(41);
        }
        /* Identificadores */
        var selectedLogo1 = document.getElementById("logo1");
        var selectedLogo2 = document.getElementById("logo2");

        var logoSelect = document.getElementById("logos");
        
        var logoURL = document.getElementById("imageInput");

        var selectedImageLogo = null;

        /* Canvas en DOOM*/
        document.addEventListener("DOMContentLoaded", function () {

            logoSelect.addEventListener("change", function () {
                var selectedLogo = logoSelect.value;
              
                canvas.remove(selectedImageLogo);

                // Construir la URL de la imagen dinámicamente
                var logo = `{{asset('img/${selectedLogo}')}}`;
                if (selectedImageLogo) {
                    canvas.remove(selectedImageLogo);
                }
                   
                fabric.Image.fromURL(logo, function (image) {
                    image.scaleToWidth(50);
                    image.scaleToHeight(50);
                    image.set({ left: 100, top: 100, selectable: true, crossOrigin: 'anonymous' });
                    canvas.add(image);
                    selectedImageLogo = image;
                    
                    canvas.renderAll();
                });

                canvas.remove(image);
        
                console.log("Logo seleccionado: " + selectedImage);
            });


            /* Se inicializa */
            var canvas = new fabric.Canvas('canvas', {
                backgroundColor: 'white'
            });

            /* Verifica la url de la imagen de proveedores de APIS */
            if (imageURL.startsWith('/storage/')) {
                /* Imagenes con CORS y locales */
                console.log('comienza con storage');
                fabric.Image.fromURL(imageURL, function (img) {
                    img.set({ crossOrigin: 'anonymous' });
                        canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
                        scaleX: canvas.width / img.width,
                        scaleY: canvas.height / img.height
                    });
                });
            } else {
                var proxyUrl = "/load-external-image?url=" + encodeURIComponent(imageURL);
                fabric.Image.fromURL(proxyUrl, function (img) {
                    img.set({ crossOrigin: 'anonymous' });
                    canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
                        scaleX: canvas.width / img.width,
                        scaleY: canvas.height / img.height
                    });
                });
            }



            /* Evento para agregar imagenes desde input (deshabilitado si no esta el boton de logo personalizado) */
           /*  imageInput.addEventListener("change", function (event) {
                var file = event.target.files[0];
                document.getElementById('clearImage').style.display = 'block';
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function (loadEvent) {
                        var imageUrl = loadEvent.target.result;
                        if (selectedImage) {
                            canvas.remove(selectedImage);
                        }
                        fabric.Image.fromURL(imageUrl, function (image) {
                            image.scaleToWidth(100);
                            image.scaleToHeight(100);
                            image.set({ left: 100, top: 100, selectable: true, crossOrigin: 'anonymous' });
                            canvas.add(image);
                            selectedImage = image;
                            canvas.renderAll();
                        });
                    };
                    reader.readAsDataURL(file);
                }
            });
 */
                      

            /* Evento para agregar texto */
            var textObject = null;
            document.getElementById('addTextButton').addEventListener('click', function() {
                var textInput = document.getElementById('textInput').value;
                const addTextButton = document.getElementById('addTextButton');
                addTextButton.textContent = 'Actualizar';
                document.getElementById('clearText').style.display = 'block';
                if (textInput.trim() !== '') {
                    // Eliminar el objeto de texto anterior si existe
                    if (textObject !== null) {
                        canvas.remove(textObject);
                    }
                    // Crear un objeto de texto
                    textObject = new fabric.Text(textInput, {
                        left: 50,
                        top: 50,
                        fontFamily: 'Sans-  ',
                        fontSize: 20,
                        fill: 'black'
                    });
                    // Agregar el objeto de texto al lienzo
                    canvas.add(textObject);
                    // Renderizar el lienzo
                    canvas.renderAll();
                }
            });


            /* Borrado manual de imagenes y texto */
            var resultImage = document.getElementById("resultImage");
            var showGeneratedImage = document.getElementById("showGeneratedImage");
            document.getElementById('clearImage').addEventListener('click', function() {
                canvas.remove(selectedImage);
            });
            document.getElementById('clearText').addEventListener('click', function() {
                canvas.remove(textObject);
            })

            /* Envio de image generada a backend */
            var sendImageToBackend = document.getElementById("sendImageToBackend");
            sendImageToBackend.addEventListener('click', saveImage, false);
            function saveImage() {
                var generatedDataURL = canvas.toDataURL({
                    format: 'png',
                    quality: 0.8
                });
                // Crear una instancia de FormData para enviar la imagen como archivo
                var formData = new FormData();
                var blob = dataURLToBlob(generatedDataURL);
                formData.append('image', blob, 'producto-personalizado.png');
                formData.append('product_id', productID);
                // Agregar el token CSRF al FormData
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                formData.append('_token', csrfToken);
                // Realizar la solicitud AJAX
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/temporal-image', true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            document.getElementById('savedText').style.display = 'block';
                            document.getElementById('errorText').style.display = 'none';
                        } else {
                            document.getElementById('errorText').style.display = 'block';
                            document.getElementById('savedText').style.display = 'none';
                        }
                    }
                };
                xhr.send(formData);
                previewImage();
            }

            /* Evento para cambiar el color del texto */
            const colorPicker = document.getElementById('colorPicker');
            colorPicker.addEventListener('input', function() {
                if (textObject !== null) {
                    textObject.set('fill', colorPicker.value);
                    canvas.renderAll();
                }
            });

            // Función para convertir Data URL a Blob
            function dataURLToBlob(dataURL) {
                var arr = dataURL.split(',');
                var mime = arr[0].match(/:(.*?);/)[1];
                var byteString = atob(arr[1]);
                var arrayBuffer = new ArrayBuffer(byteString.length);
                var uint8Array = new Uint8Array(arrayBuffer);
                for (var i = 0; i < byteString.length; i++) {
                    uint8Array[i] = byteString.charCodeAt(i);
                }
                return new Blob([arrayBuffer], { type: mime });
            }
        });

        /* Envia imagen generada a componente principal para preview */
        function previewImage() {
            var generatedDataURL = canvas.toDataURL({
                format: 'png',
                quality: 1.0
            });
            var previewImage = document.getElementById('previewImage');
            previewImage.src = generatedDataURL;
            previewImage.style.display = 'block';
        }
    </script>

    @endif
</div>