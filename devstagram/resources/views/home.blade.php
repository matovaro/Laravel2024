@extends('layouts.app')
@section('titulo')
Esto es una galeria de arte
@endsection
@section('contenido')

{{-- @forelse ($posts as $post)
<h1>{{$post->titulo}}</h1>
@empty
<h1>Vacio...</h1>
@endforelse --}}

@if ($posts->count())
    <div class=" grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($posts as $post)
        <div>
            <a href="{{ route('posts.show', ['post'=> $post, 'user' => $post->user ]) }}">
                <img src="{{ asset('uploads') .'/'. $post->imagen }}" alt="Imagen {{ $post->titulo }}" />
            </a>
        </div>
        @endforeach
    </div>
    <div class=" my-10">
        {{ $posts->links('pagination::tailwind') }}
    </div>
    @else
    <p class=" text-gray-600 uppercase text-sm text-center font-bold">Sigue a alguien para ver su arte</p>
    @endif

@endsection