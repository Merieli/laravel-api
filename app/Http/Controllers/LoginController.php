<?php

namespace Meri\NameApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index')
            ->with('mensagemSucesso', session('mensagem.sucesso'));
    }

    public function store(Request $request)
    {
        // Quando chamamos o Auth::attempt passando as credenciais por parâmetro, o que o sistema vai fazer é utilizar o provider de usuários para tentar encontrar o usuário referente as credenciais enviadas. O provider padrão é o Eloquent, ou seja, nós tentamos buscar o usuário no banco de dados.
        if (!Auth::attempt($request->only('email', 'password'))) {
            return redirect()->back()->withErrors(['Usuario ou senha inválidos']);
        };
        $request->session()->passwordConfirmed();

        return to_route('series.index');
    }

    public function destroy()
    {
        Auth::logout();

        return to_route('login');
    }
}
