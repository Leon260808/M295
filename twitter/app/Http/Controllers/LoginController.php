<?php

namespace App\Http\Controllers;

class LoginController extends Controller
{
    public function login()
    {
        return response()->json(['errors' => ['general' => 'E-Mail oder Passwort falsch.']], 422);
    }
}
