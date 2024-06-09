@extends('layouts.app')

@section('titulo')
{{ $post->titulo }}
@endsection

@section('contenido')
<div class=" container mx-auto md:flex">
    <div class="md:w-1/2">
        <img src="{{ asset('uploads') .'/'. $post->imagen }}" alt="Imagen {{ $post->titulo }}" />

        <div class=" p-3">
            <p>0 Likes</p>
        </div>
        <div>
            <a href="{{ route('post.index', ['user' => $post->user ]) }}" class=" font-bold">{{ $post->user->username
                }}</a>
            <p class=" text-sm text-gray-500">
                {{ $post->created_at->diffForHumans() }}
            </p>

            <p class=" mt-5">
                {{ $post->descripcion }}
            </p>
        </div>
    </div>
    <div class="md:w-1/2 p-5">
        <div class=" shadow bg-white p-5 mb-5">
            @auth
            <p class=" text-xl font-bold text-center mb-4">
                ¿Tienes un comentario?
            </p>

            @if (session('Mensaje'))
            <div class=" bg-green-500 pt-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                {{session('Mensaje')}}
            </div>
            @endif

            <form action=" {{ route('comentarios.store', ['post'=> $post, 'user' => $user ]) }} " method="POST">
                @csrf
                <div class="mb-5">
                    <label id="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                        Comentalo...
                    </label>
                    <textarea id="comentario" name="comentario" placeholder="... aqui" class="border p-3 w-full rounded-lg
                    @error('comentario')
                        border-red-500
                    @enderror
                    "></textarea>
                    @error('comentario')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <input type="submit" value="Plasmar"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
            </form>
            @endauth

            <div class=" bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                @if ($post->comentarios->count())

                @foreach ($post->comentarios as $comentario)
                <div class=" p-5 border-gray-300 border-b">
                    <p>
                        <a href="{{ route('post.index', ['user' => $comentario->user ]) }}" class=" font-bold">{{
                            $comentario->user->username
                            }}
                        </a>
                        {{ $comentario->comentario }}
                    </p>
                    <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                </div>

                @endforeach

                @else
                <p class=" p-10 text-center mt-10">
                    Esta obra esta intacta, sin comentarios...
                </p>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection