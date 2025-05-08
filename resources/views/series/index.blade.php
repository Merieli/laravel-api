<x-layout title="Séries" :mensagem-sucesso="$mensagemSucesso">
    @auth
    <a href="{{ route('series.create') }}"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-6">Adicionar</a>
    @endauth

    <ul class="space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400 w-full max-w-md">
        @foreach ($series as $serie)
        <li class="flex justify-between">
            @auth
            <a class="text-blue-300 font-bold hover:text-blue-100" href="{{ route('seasons.index', $serie->id) }}">
                @endauth

                {{ $serie->nome }}
                @auth
            </a>
            @endauth

            @auth
            <a href="{{ route('series.edit', $serie->id) }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-6">
                E
            </a>

            {{-- É mais seguro que um POST seja via formulário e não com simples url --}}
            <form action="{{ route('series.destroy', $serie->id) }}" method="post">
                @csrf
                {{-- O método da rota do formulário é definido para um método HTTP que o HTML não suporta, fazendo o
                laravel entender por baixo dos campos como deve tratar essa rota "mas sem transformar o post em DELETE"
                --}}
                @method('DELETE')
                <button class="font-bold p-2 text-red-50 bg-red-600 hover:bg-red-700 rounded-sm cursor-pointer ml-2">
                    Excluir
                </button>
            </form>
            @endauth
        </li>
        @endforeach
    </ul>

    {{-- o `@` faz o blade ignorar a sintaxe blade e enviar para tela como string --}}
    {{-- @{{ algo }} --}}


    <script>
        // O `JS::from` converte o array do PHP para um array do JS
        const series = {{ Js::from($series) }}
    </script>
</x-layout>