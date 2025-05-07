<x-layout title="Episódios" :mensagem-sucesso="$mensagemSucesso">
    <form method="POST" class="max-w-md w-full">
        @csrf
        <ul class="space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400 w-full">
            @foreach ($episodes as $episode)
            <li class="flex justify-between border border-gray-200 rounded-md p-2">
                Episódio {{ $episode->number }}

                {{-- Ao usar o `[]` no php no final do name de um atributo de formulário o php automaticamente converte
                esse
                valor para um array --}}
                <input type="checkbox" name="watched_episodes[]" value="{{ $episode->id }}" @if ($episode->watched)
                checked @endif
                >
            </li>
            @endforeach
        </ul>

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
            Salvar
        </button>
    </form>

</x-layout>