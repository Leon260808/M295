<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Login: Credentials prüfen und einen Sanctum-Token zurückgeben.
     */
    public function authenticate(LoginUserRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        // Auth::attempt() prüft E-Mail + Passwort gegen die users-Tabelle.
        if (! Auth::attempt($credentials)) {
            return response()->json([
                'errors' => [
                    'email' => 'E-Mail oder Passwort falsch.',
                ],
            ], 422);
        }

        // Eingeloggten User holen und einen persönlichen Access-Token erstellen.
        $token = $request->user()->createToken('guardener')->plainTextToken;

        return response()->json([
            'token' => $token,
        ]);
    }

    /**
     * Geschützter Endpunkt: gibt den geheimen Standort zurück.
     */
    public function geheim(): JsonResponse
    {
        return response()->json([
            'location' => 'Ebikonerstrasse 75, Adligenswil',
        ]);
    }

    /**
     * Authentifizierung prüfen: gibt den eingeloggten User zurück.
     */
    public function auth(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }

    /**
     * Logout: aktuellen Token löschen.
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out',
        ]);
    }
}
