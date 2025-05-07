<?php

namespace Meri\NameApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Meri\NameApp\Models\User;

class UsersController extends Controller
{
    public function create()
    {
        return view('users.create')
            ->with('mensagemSucesso', session('mensagem.sucesso'));
    }

    public function store(Request $request)
    {   
        try {
            
            $data = $request->except('_token');
            // O Hash::make é um helper do Laravel que serve para criptografar senhas. Ele utiliza o algoritmo bcrypt para fazer a criptografia, e o resultado é uma string que representa a senha criptografada.
            $data['password'] = Hash::make($data['password']);
    
            $user = User::create($data);
    
            $sameEmail = User::find($user->email);
            dd($sameEmail);
            Auth::login($user);
    
            return to_route('series.index')
                ->with('mensagem.sucesso', "Usuário '{$user->name}' cadastrado com sucesso!");
        } catch (\Throwable $th) {
            return redirect()->back()
                ->withErrors(['Erro ao cadastrar usuário, o email já existe'])
                ->withInput();
        }
    }
}
