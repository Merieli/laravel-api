<?php

namespace Meri\NameApp\Providers;

use Illuminate\Support\ServiceProvider;
use Meri\NameApp\Repositories\EloquentSeriesRepository;
use Meri\NameApp\Repositories\SeriesRepository;

class SeriesRepositoryProvider extends ServiceProvider
{
    // Faz o binding entre a interface e a implementação, ou seja, quando o Laravel encontrar a interface SeriesRepository, ele vai instanciar a classe EloquentSeriesRepository
    public array $bindings = [
        SeriesRepository::class => EloquentSeriesRepository::class,
    ];

    /**
     * Register services.
     * É o método executado para ensinar o service container sobre o que deve fazer
     * O método abaixo não é necessário ao usar a propriedade $bindings
     */
    // public function register(): void
    // {
    //     $this->app->bind(SeriesRepository::class, EloquentSeriesRepository::class);
    // }
}
