@extends('layouts.cotizador')

@section('content')
<div style="min-height: 100vh;">


    <section class="-mt-10" style="position: relative;">
        <img src="{{ asset('img/bg-login.png') }}" alt="" style="width:100%; max-height:300px; object-fit: cover; filter: brightness(80%);">
    
        <div style="position: absolute; top: 100%; left: 50%; transform: translate(-50%, -50%); display: flex; flex-direction: column; align-items: center; z-index: 1;">
            <img src="{{ asset('img/user.png') }}" alt="" style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover; backgrownd-colorbackground-color:white;">
            <h3 class="text-black font-bold text-2xl" style="white-space: nowrap; margin-top: 10px;">{{ $user->name }}</h3>

        </div>
    </section>
    
    <section class="px-10" style="margin-top: 160px;">
        @if(session('locate'))
            <div class="bg-primary border border-black text-white px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
        @endif

        <h2 class="font-semibold text-lg mb-4">Mi información</h2>
       
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
           
                <div>
                    <p>Nombre</p>
                    <input type="text" id="name" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nombre" required value="{{$user->name}}" />
                </div>
               {{--  <div>
                    <p>Teléfono</p>
                    <input type="text" id="phone" class="bg-whiteg border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ingrese su número de teléfono" value="{{$user->phone}}" />
                </div> --}}
                <div>
                    <p>Correo</p>
                    <input type="email" id="email" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Ingrese su correo electrónico" required value="{{$user->email}}" readonly/>
                    <div class="w-full">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <p class="text-sm text-red-700 font-semibold">{{ $message }}</p>
                        </span>
                        @enderror
                    </div>
                </div>

                <div>

                    <p>Localidad</p>
               
                        <input type="text" id="phone" 
                            class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" 
                            value="México" />
                </div>
                
               
            </div>

            
    </section>
</div>
    
    
@endsection