<?php

namespace Meri\NameApp\Http\Controllers;

use Illuminate\Http\Request;
use Meri\NameApp\Http\Requests\SeriesFormRequest;
use Meri\NameApp\Models\Series;
use Meri\NameApp\Repositories\SeriesRepository;

class SeriesController extends Controller
{
    // O laravel automaticamente injeta a classe SerieRepository no construtor, ou seja, não é necessário instanciar a classe manualmente, uma facilidade do laravel para injeção de dependência
    public function __construct(private SeriesRepository $repository) {
    }

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
    public function store(SeriesFormRequest $request,)
    {   
        $serie = $this->repository->add($request);

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
