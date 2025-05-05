<?php

namespace Meri\NameApp\Repositories;

use Meri\NameApp\Http\Requests\SeriesFormRequest;
use Meri\NameApp\Models\Series;

interface SeriesRepository
{
    public function add(SeriesFormRequest $request): Series;
}
