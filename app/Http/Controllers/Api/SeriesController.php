<?php

namespace Meri\NameApp\Http\Controllers\Api;

use Illuminate\Http\Request;
use Meri\NameApp\Http\Requests\SeriesFormRequest;
use Meri\NameApp\Http\Controllers\Controller;
use Meri\NameApp\Models\Series;
use Meri\NameApp\Repositories\SeriesRepository;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository)
    {
    }

    public function index(Request $request)
    {
        $query = Series::query();
        if ($request->has('nome')) {
            $query->where('nome', $request->nome);
        }

        return $query->paginate(5);
    }

    public function store(SeriesFormRequest $request)
    {
        return response()
            ->json($this->repository->add($request), 201);
    }

    public function show(int $series)
    {
        $seriesModel = Series::with('seasons.episodes')->find($series);
        if ($seriesModel === null) {
            return response()->json(['message' => 'Series not found'], 404);
        }
        ;
        return $seriesModel;
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        Series::where('id', $series)->update($request->all());
        return $series;
    }

    public function destroy(int $series)
    {
        Series::destroy($series);

        return response()->noContent();
    }
}
