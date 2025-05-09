<?php

namespace Meri\NameApp\Models;

// O uso de Eloquent é uma das principais características do Laravel, que é um ORM (Object-Relational Mapping) que facilita a interação com o banco de dados. Só com a Model vazia abaixo já é possível fazer operações básicas no banco de dados, como criar, ler, atualizar e excluir registros.
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

// Por padrão no Laravel, o nome da tabela é o plural do nome do modelo. Exemplo: se o nome do modelo for User, o nome da tabela no banco de dados será users.
// Caso o nome da tabela seja diferente do padrão, é necessário informar o nome da tabela no modelo. Exemplo: se o nome do modelo for User e o nome da tabela for usuarios, é necessário informar o nome da tabela no modelo adicionando a propriedade protected $table = 'usuarios'; no modelo.
class Series extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nome', 'cover'];

    /**
     * Com esse atributo, o Laravel vai carregar automaticamente as temporadas quando eu buscar uma série. Isso é útil para evitar consultas adicionais ao banco de dados quando eu precisar acessar as temporadas de uma série.
     */
    // protected $with = ['seasons'];

    /**
     * Método de relacionamento que possui como nome a forma como irei acessar esse relacionamento
     */
    public function seasons()
    {
        // Gera um relacionamento de 1 para N, ou seja, uma série pode ter várias temporadas
        return $this->hasMany(Season::class, 'series_id');
    }

    public function episodes()
    {
        return $this->hasManyThrough(Episode::class, Season::class);
    }

    // Quando o laravel busca os dados obtém as configurações do escopo global para aplicar a requisição
    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder) {
            $queryBuilder->orderBy('nome');
        });
    }

    /**
     * Exemplo de escopo local para facilitar a busca de séries ativas, o que permite reutilizar o código em diferentes partes do projeto. Exemplo de uso: Serie::active()->get();
     */
    // public function scopeActive(Builder $queryBuilder)
    // {
    //     return $queryBuilder->where('active', true);
    // }
}
