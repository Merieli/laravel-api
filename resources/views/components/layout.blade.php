<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }} - Controle de Séries</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <nav class="bg-gray-800 p-4 flex justify-between items-center">
        <div class="text-white text-lg font-semibold">
            <a href="{{ route('series.index') }}" class="text-white hover:text-gray-300">Séries</a>
        </div>
        {{-- A diretiva `@auth` verififca se o usuário está logado, e só se estiver exibe o trecho --}}
        @auth
        <div class="flex space-x-4">
            <a href="{{ route('logout') }}" class="text-white hover:text-gray-300">Sair</a>
        </div>
        @endauth
        {{-- A diretiva `@guest` verifica se o usuário não está logado, e só se não estiver exibe o trecho --}}
        @guest
        <div class="flex space-x-4">
            <a href="{{ route('login') }}" class="text-white hover:text-gray-300">Entrar</a>
        </div>
        @endguest
    </nav>
    <main class="w-full min-w-xs max-w-lg min-h-screen flex flex-col items-center justify-center mx-auto ">
        <h1 class="text-lg font-semibold mb-6">{{ $title }}</h1>

        @isset($mensagemSucesso)
        <div class="p-4 mb-4 text-sm text-green-700 rounded-lg bg-green-50 font-medium w-full">
            {{ $mensagemSucesso }}
        </div>
        @endisset
        @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-700 rounded-lg bg-red-50 font-medium w-full">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{ $slot }}
        <p class="text-center text-gray-500 text-xs mt-6">
            &copy;2025 Meriéli Manzano. All rights reserved.
        </p>
    </main>
</body>

</html>