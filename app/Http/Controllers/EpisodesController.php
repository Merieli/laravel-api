<?php

namespace Meri\NameApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Meri\NameApp\Models\Episode;
use Meri\NameApp\Models\Season;

class EpisodesController
{
    public function index(Season $season)
    {
        return view('episodes.index', [
            'episodes' => $season->episodes,
            'mensagemSucesso' => session('mensagem.sucesso'),
        ]);
    }

    public function update(Request $request, Season $season)
    {
        DB::transaction(function () use ($request, $season) {
            $watchedEpisodes = $request->input('watched_episodes', []);
            
            Episode::whereIn('id', $watchedEpisodes)
                ->where('season_id', $season->id)
                ->update(['watched' => true]);
                
            Episode::whereNotIn('id', $watchedEpisodes)
                ->where('season_id', $season->id)
                ->update(['watched' => false]);
        });       

        return to_route('episodes.index', $season->id)
            ->with('mensagem.sucesso', 'Episódios marcados como assistidos');
    }
}
