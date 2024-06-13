@extends('layouts.app')
@section('titulo')
Esto es una galeria de arte
@endsection
@section('contenido')

{{-- De esta manera de hace el llamado a los componentes.
Si el cierre es />, no usara slots
Si es cierre es <></>, usara slots y estos iran en medio del elemento
--}}
{{-- <x-listar-post>
    <h1>Hola desde el home</h1>
    <x-slot name="title">
        <header>Este es un header</header>
    </x-slot name="title">
</x-listar-post> --}}

<x-listar-post :posts="$posts" {{-- Equivalente a :$posts --}} />
@endsection