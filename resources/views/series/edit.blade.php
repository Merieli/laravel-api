{{-- Usa a sintaxe insegura para nao escapar os caracteres do nome da serie com `{!! !!}` --}}
<x-layout title="Editar Série {!! $series->nome !!}">
    <x-series.form :action="route('series.update', $series->id)" :nome="$series->nome" :update="true" />
</x-layout>