<?php

namespace Meri\NameApp\Http\Controllers\Api;

use Meri\NameApp\Http\Requests\SeriesFormRequest;
use Meri\NameApp\Http\Controllers\Controller;
use Meri\NameApp\Models\Series;
use Meri\NameApp\Repositories\SeriesRepository;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository)
    {
    }

    public function index()
    {
        return Series::all();
    }

    public function store(SeriesFormRequest $request)
    {
        return response()
            ->json(Series::create($request->all()), 201);
    }
}
