<?php

namespace Meri\NameApp\Models;

// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['number'];
    protected $casts = [
        'watched' => 'boolean'
    ];

    // Desta forma, quando eu tiver uma instância dessa model, vou poder acessar a propriedade season assim: $episode->season.
    public function season()
    {
        // O método belongsTo() indica que a relação é de muitos para um, ou seja, um episódio pertence a uma temporada
        return $this->belongsTo(Season::class);
    }

    /**
     * Cast que transforma o watched de smallint para boolean
     */
    // protected function watched(): Attribute
    // {
    //     return new Attribute(
    //         get: fn(int $watched) => (bool) $watched,
    //         set: fn(int $watched) => (bool) $watched,
    //     );
    // }
}
