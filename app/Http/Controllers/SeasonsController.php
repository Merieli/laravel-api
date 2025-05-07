<?php

namespace Meri\NameApp\Http\Controllers;

use Meri\NameApp\Models\Series;

class SeasonsController extends Controller
{
    public function index(Series $series)
    {
        $seasons = $series->seasons()->with('episodes')->get();

        return view('seasons.index')
            ->with(
                'seasons',
                $seasons
            )->with(
                'series',
                $series
            );
    }

    public function edit(Series $series)
    {
        return view('series.edit')
            ->with(
                'series',
                $series
            );
    }
}
