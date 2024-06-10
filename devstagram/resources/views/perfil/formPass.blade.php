@extends('layouts.app')

@section('titulo')
Cambiaras tu contraseña {{ $user->username }}
@endsection

@section('contenido')
<div class="md:flex md:justify-center">
    <div class=" md:w-1/2 bg-white shadow p-6">
        <form class="mt-10 md:mt-0" method="POST" action="{{ route('perfil.storePassword') }}">
            @csrf
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

            
            <div class="mb-5">
                <label id="password" class="mb-2 block uppercase text-gray-500 font-bold">
                    Cambiaras de contraseña?
                </label>
                <input id="password" name="password" placeholder="Cual sera?" type="password" class="border p-3 w-full rounded-lg
                    @error('password')
                    border-red-500
                @enderror" />

                @error('password')
                <p class=" bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                {{ $message }}
                </p>
                @enderror
            </div>
            <div class="mb-5">
                <label id="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                    A ver, repitela
                </label>
                <input id="password_confirmation" name="password_confirmation" placeholder="Confirmala"
                    type="password" class="border p-3 w-full rounded-lg" @error('password_confirmation') border-red-500
                    @enderror" />
                @error('password_confirmation')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <input type="submit" value="Cambiada?"
                class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />

        </form>
    </div>
</div>
@endsection