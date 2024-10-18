@extends('layouts.guest')

@section('content')

<div class="flex h-screen">
    <div
        class="flex w-full h-full bg-cover bg-center"
        style="background-image: url('{{ asset('img/login/bannerLogin.png') }}')">
        <!-- Sección izquierda: Formulario de Login (Transparente) -->
        <div class="w-1/2 flex items-center justify-center">
            <div
                class="w-full max-w-md px-8 py-6 bg-white bg-opacity-0">
                <!-- Sección transparente -->
                <h2
                    class="font-TCCCUnityHeadline text-shadow text-[35px] font-bold mb-6 text-center text-white">
                    Bienvenido
                </h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email -->
                    <div class="mb-4">
                        <label
                            class="block text-shadow-sm font-TCCCUnityHeadline text-[24px] text-white font-regular mb-2"
                            for="email">Usuario</label>
                        <input
                            class="focus:ring-0 border-t-0 border-l-0 border-r-0 w-full px-3 py-2 border-b-2 border-white  focus:outline-none focus:border-b-primary invalid:border-b-yellow-300 bg-transparent placeholder-gray-100 text-white transition-colors duration-300 ease-in-out"
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="you@example.com" />
                        @error('email')
                            <span class="invalid-feedback " role="alert">
                                <p class="text-sm text-primary font-semibold text-shadow-sm">{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <label
                            class="block text-shadow-sm font-TCCCUnityHeadline text-[24px] text-white font-regular mb-2"
                            for="password">Contraseña</label>
                        <input
                            class="focus:ring-0 border-t-0 border-l-0 border-r-0 w-full px-3 py-2 border-b-2 border-white focus:outline-none focus:border-b-primary invalid:border-b-yellow-300 bg-transparent placeholder-gray-100 text-white transition-colors duration-300 ease-in-out"
                            id="password"
                            type="password"
                            name="password"
                            placeholder="********" />
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <p class="text-sm text-primary font-semibold text-shadow-sm">{{ $message }}</p>
                            </span>
                        @enderror
                    </div>

                    <!-- Botón Login -->
                    <div class="flex items-center justify-between">
                        <button
                            type="submit"
                            class="w-[415px] h-[70px] font-TCCCUnityHeadline text-[20px] bg-primary text-white font-light py-2 px-4 rounded-lg hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-primary-light transition-colors duration-230 ease-in-out">
                            Iniciar Sesión
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sección derecha: Espacio vacío o imagen continua -->
        <div class="w-1/2">
            <!-- Espacio vacío, pero sigue mostrando el fondo -->
        </div>
    </div>
</div>

@endsection
