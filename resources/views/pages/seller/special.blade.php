@extends('layouts.cotizador')

@section('content')
    <div class="mx-auto">
        {{-- @if(session('mensaje'))
            <div class="alert alert-success">
                {{ session('mensaje') }}
            </div>
        @endif --}}
        <div class="flex justify-between mx-20">
            
            <div class="font-semibold text-slate-700 py-8 flex items-center space-x-2">
                <a class="text-secondary" href="/">Inicio</a>
                <p class="text-secondary"> / </p>
                <a class="text-secondary" href="#">Solicitudes especiales</a>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                @if(session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: '{{ session('success') }}',
                        confirmButtonText: 'Aceptar'
                    });
                @endif
            </script>
        
            <div class="mt-6">
                <!-- Modal toggle -->
                <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                    Crear nueva solicitud
                </button>
  
                <!-- Main modal -->
                <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Crear nueva solicitud
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>

                            <form action="{{ route('specialStorage') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                
                                <div class="p-4 md:p-5 space-y-4">

                                    <div class="mb-4">
                                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Descripción</label>
                                        <textarea name="description" id="description" rows="4" class="w-full p-2 border rounded-md" required></textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label for="image_reference" class="block text-gray-700 text-sm font-bold mb-2">Referencia de Imagen</label>
                                        <input type="file" name="image_reference" id="image_reference" class="w-full p-2 border rounded-md" >
                                    </div>

                                    <div class="mb-4">
                                        <label for="file" class="block text-gray-700 text-sm font-bold mb-2">Archivo</label>
                                        <input type="file" name="file" id="file" class="w-full p-2 border rounded-md" >
                                    </div>

                                </div>

                                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aceptar</button>
                                    <button data-modal-hide="default-modal" type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
  
            </div>
        </div>

        <div class="w-full mx-20 mt-5">
            @if( count($special_requests) == 0 )

                <div>
                    <p class="text-lg text-black">No hay solicitudes especiales</p>
                </div>

            @else

                <table  style="width:90%;">

                    <thead class="bg-black text-white">
                        <tr>
                            <th style="width: 5%;" class="p-4">#</th>
                            <th style="width: 30%;">Descripción</th>
                            <th style="width: 10%;">Imagen de referencia</th>
                            <th style="width: 10%;">Archivo</th>
                            <th style="width: 10%;">Fecha</th>
                            <th style="width: 15%;">Status</th>
                            <th style="width: 20%;">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">

                        @foreach($special_requests as $special_request)

                            <tr class="border">
                                <td class="m-8">{{ $loop->iteration }}</td>
                                <td>
                                    {{ $special_request->description }}
                                </td>

                                <td class="flex justify-center items-center"> 

                                    @if($special_request->image_reference !=null || $special_request->image_reference != '' )
                                        <a href="{{ asset($special_request->image_reference) }}" target="__blank">
                                            <img src="{{ asset($special_request->image_reference) }}" alt="Imagen" style="width:58px; height:80px; object-fit:contain;" class="" >
                                        </a>
                                    @else
                                        <p class="mt-5">Sin imagen</p>
                                    @endif

                                </td>
                                    
                                <td>
                                    @if($special_request->file !=null ||$special_request->file != '' )
                                        <a href="{{$special_request->file}}" class="text-blue-500 font-bold no-underline" target="__blank">Ver archivo</a>
                                    @else
                                        <p>Sin archivo</p>
                                    @endif
                                </td>

                                <td>
                                    {{ $special_request->updated_at->format('d-m-Y H:s') }}
                                </td>

                                <td>
                                   @switch($special_request->status)
                                        @case(1)
                                            <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Solicitud enviada</span>
                                           @break
                                        @case(2)
                                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Solicitud procesada</span>
                                           @break
                                        @case(3)
                                            <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Solicitud cancelada</span>
                                           @break
                                       @default
                                   @endswitch
                                </td>

                                <td class="p-4">

                                    @if ($special_request->status == 1 && (auth()->user()->hasRole("buyers-manager") || auth()->user()->hasRole("buyer")))
                                        <button data-modal-target="edit-modal-{{$special_request->id}}" data-modal-toggle="edit-modal-{{$special_request->id}}" class="block text-white bg-black hover:bg-primary hover:text-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-16" style="width: 140px;" type="button">
                                            Editar
                                        </button>
                                    @endif
                              
                                    <div id="edit-modal-{{$special_request->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-start">
                                                        Editar solicitud
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-modal-{{$special_request->id}}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>

                                                <form action="{{ route('specialUpdate') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('POST')
                                                    
                                                    <div class="p-4 md:p-5 space-y-4">
                                                        <input type="text" name="id" id="id" class="w-full p-2 border rounded-md" value="{{$special_request->id}}" hidden>

                                                        <div class="mb-4">
                                                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2 text-start">Descripción</label>
                                                            <textarea name="description" id="description" rows="4" class="w-full p-2 border rounded-md" required> {{ $special_request->description }}</textarea>
                                                        </div>

                                                        <div class="mb-4">
                                                            <label for="image_reference" class="block text-gray-700 text-sm font-bold mb-2 text-start">Referencia de Imagen</label>
                                                            <input type="file" name="image_reference" id="image_reference" class="w-full p-2 border rounded-md" >
                                                        </div>

                                                        <div class="mb-4">
                                                            <label for="file" class="block text-gray-700 text-sm font-bold mb-2 text-start">Archivo</label>
                                                            <input type="file" name="file" id="file"  class="w-full p-2 border rounded-md" >
                                                        </div>

                                                    </div>

                                                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                        <button type="submit" class="text-white bg-black hover:bg-primary  hover:text-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Actualizar</button>
                                                        <button data-modal-hide="edit-modal-{{$special_request->id}}"  type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ">Cancelar</button>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>




                                    @if (auth()->user()->hasRole("seller"))
                                        <button data-modal-target="status-modal-{{$special_request->id}}" data-modal-toggle="status-modal-{{$special_request->id}}" class="block text-white bg-black hover:bg-primary hover:text-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-16" style="width: 140px;" type="button">
                                            Cambiar status
                                        </button>

                                        
                                        <button data-modal-target="alta-modal-{{$special_request->id}}" data-modal-toggle="alta-modal-{{$special_request->id}}" class="block text-white bg-black hover:bg-primary hover:text-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-16 w-full mt-2" style="width: 140px;" type="button">
                                            Dar de alta
                                        </button>
                                    @endif
                          
                                    <div id="status-modal-{{$special_request->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-start">
                                                        Editar status
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="status-modal-{{$special_request->id}}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>

                                                <form action="{{ route('seller.especialCambiarStatus') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('POST')
                                                    
                                                    <div class="p-4 md:p-5 space-y-4">
                                                        <input type="text" name="id" id="id" class="w-full p-2 border rounded-md" value="{{$special_request->id}}" hidden>

                                                       
                                                        <div class="mb-4">
                                                            <label for="file" class="block text-gray-700 text-sm font-bold mb-2 text-start">Status</label>
                                                            <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                                                <option value="process">Procesar</option>
                                                                <option value="rejected">Rechazada</option>
                                                            </select>
                                                        </div>

                                                    </div>

                                                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                        <button type="submit" class="text-white bg-black hover:bg-primary  hover:text-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Actualizar</button>
                                                        <button data-modal-hide="status-modal-{{$special_request->id}}"  type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ">Cancelar</button>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>



                                    <div id="alta-modal-{{$special_request->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white text-start">
                                                        Dar de alta producto
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="alta-modal-{{$special_request->id}}">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>

                                                <form action="{{ route('seller.especialAltaProducto') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('POST')
                                                    <p class="text-left px-6 py-2">El producto será dado de alta en el catálogo de productos, sin embargo, solo estará disponible para este portal. Al ser un producto especial, algunas características del mismo se verán limitadas, como el stock.</p>
                                                    <div class="p-4 md:p-5 space-y-4">
                                                        <input type="text" name="id" id="id" class="w-full p-2 border rounded-md" value="{{$special_request->id}}" hidden>

                                                        <div class="w-full px-2">
                                                            <label class="block text-gray-700 text-sm font-bold mb-2 text-start">Nombre</label>
                                                            <input type="text" name="name" id="" class="block text-gray-700 text-sm font-bold mb-2 text-start w-full" value="{{ $special_request->description}}" required>
                                                        </div>

                                                        <div class="w-full px-2">
                                                            <label class="block text-gray-700 text-sm font-bold mb-2 text-start">Descripción</label>
                                                            <textarea type="text" name="description" id="" class="block text-gray-700 text-sm font-bold mb-2 text-start w-full">{{ $special_request->description}}</textarea>
                                                        </div>
                                                       

                                                        <div class="w-full px-2">
                                                            <label class="block text-gray-700 text-sm font-bold mb-2 text-start">Imagen</label>
                                                            <input type="file" name="file" id="" accept="image/*" class="block text-gray-700 text-sm font-bold mb-2 text-start w-full" required>
                                                        </div>
                                                       


                                                        <div class="flex mb-4">
                                                            <div class="w-1/2 px-2">
                                                                <label class="block text-gray-700 text-sm font-bold mb-2 text-start">Precio final por artículo</label>
                                                                <input type="number" name="price" id="" class="block text-gray-700 text-sm font-bold mb-2 text-start w-full" placeholder="Ingrese el precio final por artículo" value="0" required>
                                                            </div>
                                                            <div class="w-1/2 px-2">
                                                                <label class="block text-gray-700 text-sm font-bold mb-2 text-start">Stock (opcional)</label>
                                                                <input type="number" name="stock" id="" class="block text-gray-700 text-sm font-bold mb-2 text-start w-full"  placeholder="Ingrese el stock" value="0" required>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                        <button type="submit" class="text-white bg-black hover:bg-primary  hover:text-black focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Dar de alta</button>
                                                        <button data-modal-hide="alta-modal-{{$special_request->id}}"  type="button" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ">Cancelar</button>
                                                    </div>

                                                </form> 

                                            </div>
                                        </div>
                                    </div>

                                </td>
                                
                            </tr>

                        @endforeach
                         
                    </tbody>

              </table>
                
              <div>
                {{ $special_requests->links() }}
              </div>
            @endif

        </div>

       

        

        
    </div>
@endsection
