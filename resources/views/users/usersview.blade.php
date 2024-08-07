@extends('layouts.app')

@section('content')
<div class="bg-white p-4 m-3 rounded-lg shadow flex justify-between w-full">
    <div class="table-responsive">
        <div class="flex justify-between">
            <h1 class="text-2xl ml-10">
                USUARIOS
            </h1>
            <div class="flex gap-4">
                <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="btn btn-outline-primary" type="button">
                    Importar usuarios
                </button>
                <button data-modal-target="AGREGAR" data-modal-toggle="AGREGAR" class="btn btn-outline-primary" type="button">
                    Agregar usuario
                </button>
            </div>
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
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('create.user') }}" method="POST" id="userForm">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                <input type="text" id="name" name="name" placeholder="Ingresa el nombre completo" required class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                                <input type="email" placeholder="Ingresa el email" id="email" name="email" required class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </div>

                            <div class="mb-4">
                                <label for="role" class="block text-sm font-medium text-gray-700">
                                    Selecciona un rol
                                </label>
                                <select id="role" name="role" required class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="" disabled selected>Selecciona un rol</option>
                                    <option value="1">Administrador</option>
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
        <br>

        @if(session('msg'))
        <div class="alert alert-success" role="alert">
            <strong class="font-bold">¡Éxito!</strong>
            <span class="block sm:inline">{{ session('msg') }}</span>
        </div>
        @endif

        <div class="d-flex justify-content-end">
            <form action="{{ route('allusers') }}" method="GET" class="flex items-center">
                <input type="text" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="search" placeholder="Buscar usuarios..." value="{{ request()->input('search') }}">
                <button type="submit" class="btn btn-outline-success">
                    Buscar
                </button>
            </form>
            @if(request()->input('search'))
            <form action="{{ route('allusers') }}" method="GET" class="flex items-center ml-2">
                <button type="submit" class="btn btn-outline-danger">
                    Limpiar busqueda
                </button>
            </form>
            @endif
        </div>
        <br>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($rolesusers as $roleuser)
                        @if($roleuser->user_id == $user->id)
                        {{ $roleuser->roles->display_name }}
                        @endif
                        @endforeach
                    </td>
                    <td>
                        <div class="grid grid-cols-2 gap-2">
                            <a>
                                <button data-modal-target="password-modal-{{$user->id}}" data-modal-toggle="password-modal-{{$user->id}}" class="btn btn-outline-success" type="button" data-tooltip-target="tooltip-password" data-tooltip-placement="top">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" style="width: 0.9rem; height: 0.9rem;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                    </svg>
                                </button>
                                <div id="tooltip-password" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                                    Modificar Password
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </a>
                            <a href="/admin/users/{{ $user->id }}">
                                <button class="btn btn-outline-info" data-tooltip-target="tooltip-report" data-tooltip-placement="top">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" style="width: 0.9rem; height: 0.9rem;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                                <div id="tooltip-report" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                                    Generar Reporte
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </a>
                            <a>
                                <button data-modal-target="editarUsuario-{{$user->id}}" data-modal-toggle="editarUsuario-{{$user->id}}" class="btn btn-outline-warning" type="button" data-tooltip-target="tooltip-right" data-tooltip-placement="top">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" style="width: 0.9rem; height: 0.9rem;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </button>
                                <div id="tooltip-right" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                                    Editar Usuario
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                            </a>
                            <a>
                                <form class="form-delete m-0" action="{{ route('delete.user') }}" method="post">
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger" data-tooltip-target="tooltip-delete-user" data-tooltip-placement="top">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" style="width: 0.9rem; height: 0.9rem;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                    <div id="tooltip-delete-user" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 tooltip">
                                        Eliminar Usuario
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>

                                </form>
                            </a>
                        </div>

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
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
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
                                                <input type="text" placeholder="Ingrese contraseña nueva" required name="password" class="w-7/10 p-2 border border-gray-300 rounded-lg">
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
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4 d-flex justify-content-end">
            {{ $users->appends(['search' => request()->input('search')])->links() }}
        </div>
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
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{ route('update.user') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <input type="id" value="{{$user->id}}" hidden id="id" name="id">
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" id="name" name="name" value="{{$user->name}}" placeholder="Ingresa el nombre completo" required class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                        <input type="email" value="{{$user->email}}" placeholder="Ingresa el email" id="email" name="email" required class="form-input mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
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
@endsection

@section('scripts')
<script>
    $('.form-delete').submit(function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡El usuario se eliminara permanentemente.!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });
</script>
@endsection