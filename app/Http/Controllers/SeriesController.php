<?php

namespace Meri\NameApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Meri\NameApp\Http\Requests\SeriesFormRequest;
use Meri\NameApp\Models\Episode;
use Meri\NameApp\Models\Season;
use Meri\NameApp\Models\Series;

class SeriesController extends Controller
{
    function index(Request $request)
    {
        // Retorna uma collection que é uma lista de objetos, no caso, uma lista de séries
        $series = Series::all();
        $mensagemSucesso = session('mensagem.sucesso');
        // o método forget() remove o valor da sessão, ou seja, ele remove a mensagem de sucesso da sessão
        // $request->session()->forget('mensagem.sucesso');

        return view('series.index')->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    // A request vai possuir o campo token csrf adicionado automaticamente
    public function store(SeriesFormRequest $request)
    {   
        // Essa função espera por parametro uma closure, que é uma função anônima, e tudo que estiver dentro dela será executado dentro de uma única transação no banco de dados, garantindo que caso ocorra algum erro, automaticamente gere o rollback, ou seja, desfaz todas as operações realizadas no banco de dados
        // O `use ($request, &$serie)` é uma forma de passar variáveis para dentro da closure, o `&` indica que a variável será passada por referência, ou seja, qualquer alteração feita na variável dentro da closure será refletida fora dela 
        $serie = DB::transaction(function () use ($request, &$serie) {
            // Toda model do Eloquent tem esse método estático create que recebe um array associativo com os campos que serão preenchidos no banco de dados usando o Mass Assignment
            $serie = Series::create($request->all());
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
                        'number' => $i
                    ];
                }
            }
            Episode::insert($episodes);

            return $serie;
        }, 5);
        // Para evitar o dead lock, é passado a quantidade de tentativas que o Laravel vai fazer para executar a transação, nesse caso 5 vezes

        // Uma rota post sempre precisa redirecionar o usuário para uma rota get
        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso!");
    }

    // Ao passar o tipo da `$request` como uma classa validadora, o Laravel automaticamente valida os dados da requisição antes de chamar o método
    public function destroy(Series $series, Request $request)
    {
        $series->delete();
        // O método session() retorna a sessão atual do usuário e o método put() adiciona um valor na sessão. O primeiro parâmetro é a chave e o segundo parâmetro é o valor
        // $request->session()->put('mensagem.sucesso', 'Série removida com sucesso!');

        // O método flash() adiciona um valor na sessão, que em sequida é removido automaticamente
        // $request->session()->flash('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso!");

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso!");
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('series', $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        // O método fill() preenche os campos da model com os dados da requisição, mas não salva no banco de dados
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$series->nome}' atualizada com sucesso!");
    }
}
