@extends('layouts.app')

@section('titulo')
{{ $user->name }}
@endsection

@section('contenido')
<div class="flex justify-center">
    <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
        <div class="w-8/12 lg:w-6/12 px-5">
            <img src="{{ $user->imagen ? asset('perfiles') . '/'. $user->imagen : asset('img/usuario.svg') }}"
                alt="Imagen de usuario" class=" rounded-full" />
        </div>
        <div
            class="md:w-8/12 lg:w-6/12 px-5 md:flex md:flex-col items-center md:justify-center md:items-start py-10 md:py-10">

            <div class=" flex items-center gap-2">
                <p class="text-gray-700 text-2xl">{{ $user->username }}</p>

                @auth
                @if ($user->id === auth()->user()->id)
                <a class=" text-gray-500 hover:text-gray-600 cursor-pointer" href="{{ route('perfil.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>

                </a>
                @endif
                @endauth
            </div>
            <p class=" text-gray-800 text-sm mb-3 font-bold">
                {{ $user->followers->count() }}
                <span class="font-normal"> @choice('Seguidor|Seguidores', $user->followers->count()) </span>
            </p>

            <p class=" text-gray-800 text-sm mb-3 font-bold">
                {{ $user->follows->count() }}
                <span class="font-normal"> @choice('Seguido|Seguidos', $user->follows->count())</span>
            </p>

            <p class=" text-gray-800 text-sm mb-3 font-bold">
                {{ $user->posts->count() }}
                <span class="font-normal"> @choice('Post|Posts', $user->posts->count())</span>
            </p>

            @auth
            @if ($user->id !== auth()->user()->id)

                @if ($user->checkFollow(auth()->user()))
                    <form method="POST" action="{{ route('users.unfollow', ['user' => $user]) }}">
                        @csrf
                        @method('DELETE')
                        <div class=" my-4">
                            <button type="submit" title="Tomemos nuestro camino">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path d="M10.375 2.25a4.125 4.125 0 1 0 0 8.25 4.125 4.125 0 0 0 0-8.25ZM10.375 12a7.125 7.125 0 0 0-7.124 7.247.75.75 0 0 0 .363.63 13.067 13.067 0 0 0 6.761 1.873c2.472 0 4.786-.684 6.76-1.873a.75.75 0 0 0 .364-.63l.001-.12v-.002A7.125 7.125 0 0 0 10.375 12ZM16 9.75a.75.75 0 0 0 0 1.5h6a.75.75 0 0 0 0-1.5h-6Z" />
                                  </svg>
                                  
                            </button>
                        </div>
                    </form>
                @else
                    <form method="POST" action="{{ route('users.follow', ['user' => $user]) }}">
                        @csrf
                        <div class=" my-4">
                            <button type="submit" title="Lo seguimos?">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
                                  </svg>
                                  
                            </button>
                        </div>
                    </form>
                @endif
            @endif
            @endauth
        </div>
    </div>
</div>

<section class=" container mx-auto mt-10">
    <h2 class=" text-4xl text-center font-black my-10">El arte del artista...</h2>

    @if ($posts->count())
    <div class=" grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($posts as $post)
        <div>
            <a href="{{ route('posts.show', ['post'=> $post, 'user' => $user ]) }}">
                <img src="{{ asset('uploads') .'/'. $post->imagen }}" alt="Imagen {{ $post->titulo }}" />
            </a>
        </div>
        @endforeach
    </div>
    <div class=" my-10">
        {{ $posts->links('pagination::tailwind') }}
    </div>
    @else
    <p class=" text-gray-600 uppercase text-sm text-center font-bold">Arte en proceso...</p>
    @endif
</section>
@endsection