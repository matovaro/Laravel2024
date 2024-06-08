@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
<div class=" container mx-auto flex">
    <div class="md:w-1/2">
        <img src="{{ asset('uploads') .'/'. $post->imagen }}" alt="Imagen {{ $post->titulo }}" />

        <div class=" p-3">
            <p>0 Likes</p>
        </div>
        <div>
            <a href="{{ route('post.index', ['user' => $post->user ]) }}" class=" font-bold">{{ $post->user->username }}</a>
            <p class=" text-sm text-gray-500">
                {{ $post->created_at->diffForHumans() }}
            </p>

            <p class=" mt-5">
                {{ $post->descripcion }}
            </p>
        </div>
    </div>
    <div class="md:w-1/2">
    </div>
</div>
@endsection