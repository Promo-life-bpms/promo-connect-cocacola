@extends('layouts.guest')

@section('content')

<div class="flex md:flex-row xs:flex-col-reverse justify-center items-center w-full h-screen">
    <div class="md:w-1/2 xs:w-full h-screen flex flex-col items-center justify-center">
        <div class="md:w-[435px] xs:w-[300px]">
            <h1 class="text-2xl font-bold text-black text-center">
                Bienvenido
            </h1>
            <form class="w-full p-4" method="POST" action="{{ route('login') }}">
                    @csrf 
                <label class="block hh-text-shadow text-black text-left mb-1 md:mb-0 pr-4 pb-2 text-xl" for="inline-full-name">
                    Usuario
                </label>
                <div class="w-full">
                    <input type="email" class="appearance-none border-hidden rounded w-full py-2 px-4 text-gray-700" name="email" value="{{ old('email') }}" placeholder="Ingrese su correo" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback " role="alert">
                        <p class="text-sm text-red-700 font-semibold">{{ $message }}</p>
                    </span>
                    @enderror
                </div>
                <div class="w-full h-0.5 bg-gray-400 mb-10"></div>
                <label class="block hh-text-shadow pb-2 text-black text-left mb-1 md:mb-0 pr-4 text-xl" for="inline-password">
                    Contraseña
                </label>
                <div class="w-full mb-2">
                    <input id="password" type="password" class="appearance-none border-hidden rounded w-full py-2 px-4 text-gray-700" placeholder="Ingrese su contraseña" name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <p class="text-sm text-red-700 font-semibold">{{ $message }}</p>
                    </span>
                    @enderror
                </div>
                <div class="w-full h-0.5 bg-gray-400"></div>
                <br>
                <div class="md:flex md:items-center mt-4">
                    <div class="w-full mb-2">
                        <button type="submit" class="text-black bg-hh-green text-xl font-bold hover:bg-hh-green-dark inline-block w-full rounded px-7 pb-2.5 pt-3 leading-normal shadow-[0_4px_9px_-4px_#000000] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                            Iniciar Sesión
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="md:w-1/2 xs:w-full bg-bglogin h-screen " >
           
            
        </div>

</div>
   
@endsection
