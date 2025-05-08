<?php

namespace Meri\NameApp\Repositories;

use Illuminate\Support\Facades\DB;
use Meri\NameApp\Http\Requests\SeriesFormRequest;
use Meri\NameApp\Models\Episode;
use Meri\NameApp\Models\Season;
use Meri\NameApp\Models\Series;

// Classe responsável por lidar com banco de dados
class EloquentSeriesRepository implements SeriesRepository
{
    public function add(SeriesFormRequest $request): Series
    {
        // Essa função espera por parametro uma closure, que é uma função anônima, e tudo que estiver dentro dela será executado dentro de uma única transação no banco de dados, garantindo que caso ocorra algum erro, automaticamente gere o rollback, ou seja, desfaz todas as operações realizadas no banco de dados
        // O `use ($request, &$serie)` é uma forma de passar variáveis para dentro da closure, o `&` indica que a variável será passada por referência, ou seja, qualquer alteração feita na variável dentro da closure será refletida fora dela 
        return DB::transaction(function () use ($request) {
            // Toda model do Eloquent tem esse método estático create que recebe um array associativo com os campos que serão preenchidos no banco de dados usando o Mass Assignment
            $serie = Series::create([
                'nome' => $request->nome
            ]);
            $seasons = [];
            for ($i = 1; $i <= $request->seasonsQtd; $i++) {
                $seasons[] = [
                    'number' => $i,
                    'series_id' => $serie->id,
                ];
            }
            Season::insert($seasons);
    
            $episodes = [];
            foreach ($serie->seasons as $season) {
                for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j
                    ];
                }
            }
            Episode::insert($episodes);

            return $serie;
        }, 5);
        // Para evitar o dead lock, é passado a quantidade de tentativas que o Laravel vai fazer para executar a transação, nesse caso 5 vezes
    }
}
