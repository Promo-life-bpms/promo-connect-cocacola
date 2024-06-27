<div>
    <div class="row px-3">
        <div class="card w-100">
            <div class="card-body">
                {{-- <div>
                    <input wire:model='keyWord' type="text" class="form-control" name="search" id="search"
                        placeholder="Buscar">
                </div> --}}

                @if(session('msg'))
                    <div class="alert alert-success" role="alert">
                        <strong class="font-bold">¡Éxito!</strong>
                        <span class="block sm:inline">{{ session('msg') }}</span>
                    </div>
                @endif

                <div class="flex justify-between">
                    <h1 class="text-2xl ml-10">
                        USUARIOS
                    </h1>
                    <div>
                        
                    <div class="flex gap-4">
                        <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-primary hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                            Importar usuarios
                        </button>
                        <button data-modal-target="AGREGAR" data-modal-toggle="AGREGAR" class="block text-white bg-primary hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                            Agregar usuario
                        </button>
                    </div>
                    <br>
                              
                    <!-- Main modal -->
                    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Importar usuarios
                                    </h3>
                                    
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 md:p-5 space-y-4">
                                    <form action="{{ route('exportUser') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <p>Seleccionar archivo:</p>
                                        <input type="file" name="excel" id="excel" accept=".xlsx, .xls">
                                        <br>
                                        <button type="submit">Enviar</button>
                                    </form>
                                </div> 
                            </div>
                        </div>
                    </div>                          
                        
                    <!-- Main modal para usuarios -->
                    <div id="AGREGAR" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Agregar usuario
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="AGREGAR">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                    
                                <div class="modal-body">
                                    <form action="{{ route('create.user') }}" method="POST" id="userForm">
                                        @csrf
                                        <div class="mb-4">
                                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                            <input type="text" id="name" name="name" placeholder="Ingresa el nombre completo" required  class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        </div>
                                
                                        <div class="mb-4">
                                            <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                                            <input type="email"  placeholder="Ingresa el email" id="email" name="email" required class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        </div>

                                        <div class="mb-4">
                                            <label for="role" class="block text-sm font-medium text-gray-700">
                                                Selecciona un rol
                                            </label>
                                            <select id="role" name="role" required class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                                <option value="" disabled selected>Selecciona un rol</option>
                                                <option value="2">Vendedor</option>
                                                <option value="3">Compras</option>
                                                <option value="4">Comprador</option>
                                            </select>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Registrar usuario</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>  
                    </div>

                        <div class="md:col-end-3 col-span-1 lg:px-12 lg:ml-40">
                            <label for="default-search"
                                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                </div>
                                <input type="search"
                                    class="border-2 lg:block border-gray-400 py-2 text-sm bg-white rounded-md pr-10 pl-2 focus:outline-none focus:bg-white focus:text-gray-900 w-full"
                                    placeholder="Buscar..." autocomplete="off" name="busqueda" wire:model="search">
                                <span class="absolute inset-y-0 right-0 flex items-center pr-2">
                                    <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">
                                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white container h-auto pt-4">
                    <div class="relative overflow-x-auto md:col-span-2 ">
                        <div class="relative" wire:loading.class="opacity-70">
                            
                            <table class="w-full text-sm text-left text-gray-500 ">
                                <thead class="text-xs text-white uppercase bg-primary">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            NOMBRE
                                        </th>
                                        <th scope="col" class="px-6 py-3 hidden md:table-cell ">
                                            E-MAIL
                                        </th>


                                        <th scope="col" class="px-6 py-3   hidden md:table-cell ">
                                            COMPRAS PENDIENTES
                                        </th>
                                        <th scope="col" class="px-6 py-3">

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($users as $user)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row"
                                                class=" px-2 md:px-6 py-1 md:py-4 font-medium  whitespace-nowrap dark:text-white">
                                                <p class="text-gray-900"> {{ $user->name }} </p>
                                                <p class="md:hidden"> {{ $user->email }} </p>
                                                <p class="md:hidden">Compras pendientes: 1</p>
                                            </th>
                                            <td class="px-6 py-4  hidden md:table-cell	">
                                                {{ $user->email }}
                                            </td>
                                            <td class="px-6 py-4  hidden md:table-cell ">
                                                1
                                            </td>
                                            <td class="">
                                                
                                                <button data-modal-target="password-modal-{{$user->id}}" data-modal-toggle="password-modal-{{$user->id}}" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                                                    Cambiar contraseña
                                                </button>
                                                
                                                <div id="password-modal-{{$user->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    {{ $user->name }}
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="password-modal-{{$user->id}}">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            
                                                            <div class="p-4 md:p-5 space-y-4">
                                                                <p class="text-base">Asignar contraseña manualmente</p>
                                                                
                                                                <form action="{{ route('admin.changeManualPassword') }}" method="POST" class="w-full">
                                                                    @csrf
                                                                    <div class="flex space-x-2 w-full">
                                                                        <input type="text" name="user_id" value="{{ $user->id }}" hidden>
                                                                        <input type="text" placeholder="Ingrese contraseña nueva" name="password" class="w-7/10 p-2 border border-gray-300 rounded-lg">
                                                                        <button type="submit" class="w-3/10 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cambiar</button>
                                                                    </div>
                                                                </form>

                                                                <form action="{{ route('admin.changeAutomaticPassword') }}" method="POST" class="w-full">
                                                                    @csrf
                                                                    <div class="mt-10">
                                                                        <input type="text" name="user_id" value="{{ $user->id }}" hidden>
                                                                        <p class="text-base">Asignación automática</p>
                                                                        <button type="submit" class="w-3/10 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-2">Cambiar automaticamente</button>
                                                                    </div>
                                                                </form>                

                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="flex items-center p-4 md:p-5 rounded-b dark:border-gray-600">
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <a href="/admin/users/{{ $user->id }}">
                                                    <button class="bg-[#2B2D2F] text-white h-[50px] w-30 px-1 text-xs">Generar reporte</button>
                                                </a>
                                                <a>
                                                    <button data-modal-target="editarUsuario-{{$user->id}}" data-modal-toggle="editarUsuario-{{$user->id}}" class="bg-[#2B2D2F] text-white h-[50px] w-30 px-1 text-xs" type="button">
                                                        Editar usuario
                                                    </button>
                                                </a>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Main modal para usuarios -->
                    @foreach($users as $user)
                    <div id="editarUsuario-{{$user->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Editar a {{$user->name}}
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editarUsuario-{{$user->id}}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                    
                                <div class="modal-body">
                                    <form action="{{ route('update.user') }}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <input type="id"  value="{{$user->id}}" hidden id="id" name="id" >
                                        </div>
                                        <div class="mb-4">
                                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                            <input type="text" id="name" name="name" value="{{$user->name}}" placeholder="Ingresa el nombre completo" required  class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        </div>
                                
                                        <div class="mb-4">
                                            <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                                            <input type="email"  value="{{$user->email}}" placeholder="Ingresa el email" id="email" name="email" required class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        </div>

                                        <div class="mb-4">
                                            <label for="role" class="block text-sm font-medium text-gray-700">Selecciona un rol</label>
                                            <select id="role" name="role" required class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                                <option value="" disabled>Selecciona un rol</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}" {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }}>{{ $role->display_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Modificar usuario</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>  
                    </div>
                    @endforeach

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

                        .opacity-70 {
                            opacity: 0.7;
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
            </div>
        </div>
    </div>
</div>
