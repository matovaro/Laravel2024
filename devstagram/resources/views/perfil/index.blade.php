@extends('layouts.app')

@section('titulo')
Editandote -> {{ $user->username }}
@endsection

@section('contenido')
<div class="md:flex md:justify-center">
    <div class=" md:w-1/2 bg-white shadow p-6">
        <form class="mt-10 md:mt-0" method="POST" action="{{ route('perfil.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-5">
                <label id="name" class="mb-2 block uppercase text-gray-500 font-bold">
                    Nuevo nombre, nueva identidad ...
                </label>
                <input id="name" name="name" placeholder="Tu nuevo nombre va aqui" type="text" class="border p-3 w-full rounded-lg
                @error('name')
                    border-red-500
                @enderror
                " value="{{ auth()->user()->name }}" />
                @error('name')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="mb-5">
                <label id="username" class="mb-2 block uppercase text-gray-500 font-bold">
                    ¿Como deseas que te identifiquen?
                </label>
                <input id="username" name="username" placeholder="Deja que los demas te identifiquen..." type="text"
                    class="border p-3 w-full rounded-lg
                @error('username')
                    border-red-500
                @enderror
                " value="{{ auth()->user()->username }}" />
                @error('username')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{ $message }}
                </p>
                @enderror
            </div>
            <div class="mb-5">
                <label id="email" class="mb-2 block uppercase text-gray-500 font-bold">
                    Cambiaste de correo?
                </label>
                <input id="email" name="email" placeholder="Tu correo" type="email" class="border p-3 w-full rounded-lg
                    @error('email')
                    border-red-500
                @enderror
                " value="{{ auth()->user()->email }}" />
                @error('email')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="mb-5">
                <label id="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                    Nueva foto?
                </label>
                <input id="imagen" name="imagen" type="file" class="border p-3 w-full rounded-lg"
                    accept=".jpg,.jpeg,.gif,.png" />
            </div>


            <div class="mb-5">
                <label id="currentPassword" class="mb-2 block uppercase text-gray-500 font-bold">
                    Cual es tu contraseña?
                </label>
                <input id="currentPassword" name="currentPassword" placeholder="Solo para confirmar que seas tu" type="password"
                    class="border p-3 w-full rounded-lg
                    @error('currentPassword')
                    border-red-500
                @enderror" />

                @if (session('MensajePassword'))
                <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{ session('MensajePassword') }}
                </p>
                @endif
            </div>
            
            <input type="submit" value="Editado?"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />

        </form>
    </div>
</div>
@endsection