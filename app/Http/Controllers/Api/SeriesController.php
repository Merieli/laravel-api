<?php

namespace Meri\NameApp\Http\Controllers\Api;

use Meri\NameApp\Http\Requests\SeriesFormRequest;
use Meri\NameApp\Http\Controllers\Controller;
use Meri\NameApp\Models\Series;
use Meri\NameApp\Repositories\SeriesRepository;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository)
    {
    }

    public function index()
    {
        return Series::all();
    }

    public function store(SeriesFormRequest $request)
    {
        return response()
            ->json($this->seriesRepository->add($request), 201);
    }
}
