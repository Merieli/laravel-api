<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Meri\NameApp\Models\User;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    /**
     * A ideia do verbo PUT é exatamente ser idempotente, ou seja, se nós enviamos um recurso que não existe, ele será criado. Se enviamos um recurso existente, ele será atualizado. Sendo assim, se eu enviar 10 mil requisições do tipo PUT, eu continuarei sempre com 1 único recurso, independente dele já existir antes ou não.
     * 
     *  O verbo POST não é idempotente. Se você fizer a mesma requisição 2 vezes usando o verbo POST, 2 recursos diferentes serão criados.
     */


    // Toda rota definida nesse arquivo tem por padrão o prefixo /api
    Route::apiResource('/series', \Meri\NameApp\Http\Controllers\Api\SeriesController::class);
    //  Rota de subrecurso
    Route::get('/series/{series}/seasons', function (\Meri\NameApp\Models\Series $series) {
        return $series->seasons;
    });

    Route::get('/series/{series}/episodes', function (\Meri\NameApp\Models\Series $series) {
        return $series->episodes;
    });

    /**
     * Analisando o HTTP corretamente, quando quero atualizar 1 único campo de um dado no db é certo
     * utilizar o PATCH
     */
    Route::patch('/episodes/{episode}', function (\Meri\NameApp\Models\Episode $episode, Request $request) {
        $episode->watched = $request->watched;
        $episode->save();

        return $episode;
    });
});


// Autenticação: identifica um usuário
// Autorização: permite que um determinado usuário faça uma tarefa
Route::post('/login', function (Request $request) {
    $credentials = $request->only(['email', 'password']);
    if (\Illuminate\Support\Facades\Auth::attempt($credentials) === false) {
        return response()->json('Unauthorized', 401);
    }

    $user = Auth::user();
    $user->tokens()->delete();
    $token = $user->createToken('token', ['series:delete']);

    return response()->json($token->plainTextToken);
});

