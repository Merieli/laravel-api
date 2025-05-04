<x-layout title="Temporadas de {!! $series->nome !!}">
    <ul class="space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400 w-full max-w-md">
        @foreach ($seasons as $season)
            <li class="flex justify-between">
                {{ $season->number }}

                <span class="text-bold bg-gray-700 p-2 rounded-sm text-white">
                    {{ $season->episodes->count() }}
                </span>
            </li>
        @endforeach
    </ul>
</x-layout>