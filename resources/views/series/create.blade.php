<x-layout title="Nova Serie">
    <form action="{{ route('series.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nome">Nome:</label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="text" name="nome" id="nome" value="{{ old('nome') }}">

            <label class="block text-gray-700 text-sm font-bold mb-2" for="seasonsQtd">
                Número de temporadas:
            </label>
            <input type="number" name="seasonsQtd" id="seasonsQtd"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                value="{{ old('seasonsQtd') }}" min="1" max="100">

            <label class="block text-gray-700 text-sm font-bold mb-2" for="episodesPerSeason">
                Episódios por temporada:
            </label>
            <input type="number" name="episodesPerSeason" id="episodesPerSeason"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                value="{{ old('episodesPerSeason') }}" min="1" max="100">
        </div>


        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
            Adicionar
        </button>
    </form>
</x-layout>