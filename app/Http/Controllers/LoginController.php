<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class LoginController extends Controller
{
    public function form()
    {
        return view('login-form');
    }


    public function loginValidate(Request $request)
    {
        $credentials= $request->validate([
            'email'=> ['required', 'email'],
            'password'=> ['required']
        ],
        [
            'email.required'=> 'Email obrigatório',
            'email.email'=> 'Informe um email válido',
            'password.required'=> 'Senha obrigatória'
        ]);

        if( Auth::attempt($credentials) ){

            $user= User::where('email', $request->email )->first();

            $request->session()->put('user', $user);
            $request->session()->regenerate();

            return redirect('list_catalog');

        }else{
            return redirect()->back()->with('erro', 'Login ou senha inválidos');
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('list_catalog');
    }
}
