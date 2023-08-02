<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function form()
    {
        return view('login-form');
    }


    public function loginValidate(Request $request)
    {

    }
}
