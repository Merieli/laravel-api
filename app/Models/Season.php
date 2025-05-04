<?php

namespace Meri\NameApp\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// O comando `php artisan make:model NomeModel -m` cria o model e sua respectiva migration 
class Season extends Model
{
    use HasFactory;
    protected $fillable = ['number'];

    public function series()
    {
        // O método belongsTo() indica que a relação é de muitos para um, ou seja, uma temporada pertence a uma série
        return $this->belongsTo(Series::class);
    }

    public function episodes()
    {
        // O método hasMany() indica que a relação é de um para muitos, ou seja, uma temporada pode ter vários episódios
        return $this->hasMany(Episode::class);
    }

    public function numberOfWatchedEpisodes(): int
    {
        return $this->episodes
            ->filter(fn($episode) => $episode->watched)
            ->count();
    }
}
