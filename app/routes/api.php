<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('hallo-velo')->group(function () {

    Route::get('/bikes', function () {
        $pdo = DB::connection()->getPdo();
        $stmt = $pdo->prepare('SELECT * FROM bikes');
        $stmt->execute();
        return response()->json($stmt->fetchAll(PDO::FETCH_ASSOC));
    });

    Route::get('/bikes/{id}', function (int $id) {
        $pdo = DB::connection()->getPdo();
        $stmt = $pdo->prepare('SELECT * FROM bikes WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return response()->json($stmt->fetch(PDO::FETCH_ASSOC) ?: null);
    })->whereNumber('id');
});

Route::prefix('responder')->group(function () {

    Route::get('/hi', function () {
        return 'Hallo Welt';
    });

    Route::get('/number', function () {
        return rand(1, 10);
    });

    Route::get('/www', function () {
        return redirect('https://www.ict-bz.ch');
    });

    Route::get('/favi', function () {
        return response()->download(public_path('favicon.ico'));
    });

    Route::get('/hi/{name}', function (string $name) {
        return 'Hi ' . $name;
    });

    Route::get('/weather', function () {
        $weather = [
            'city' => 'Luzern',
            'temperature' => 20,
            'wind' => 10,
            'rain' => 0,
        ];
        return $weather;
    });

    Route::get('/error', function () {
        return response()->json(['error' => 'Nicht authorisiert!'], 401);
    });

    Route::get('/multiply/{number1}/{number2}', function (int $number1, int $number2) {
        return $number1 * $number2;
    })->whereNumber(['number1', 'number2']);
});

