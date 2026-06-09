<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ClownController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TopicController;
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

Route::prefix('bookler')->group(function () {

    Route::prefix('books')->group(function () {
        Route::get('/', [BookController::class, 'index']);
        Route::get('/{id}', [BookController::class, 'show'])->whereNumber('id');
    });

    Route::prefix('book-finder')->group(function () {
        Route::get('/slug/{slug}', [BookController::class, 'findBySlug']);
        Route::get('/year/{year}', [BookController::class, 'findByYear'])->whereNumber('year');
        Route::get('/max-pages/{pages}', [BookController::class, 'findByMaxPages'])->whereNumber('pages');
    });

    Route::get('/search/{search}', [BookController::class, 'search']);

    Route::prefix('meta')->group(function () {
        Route::get('/count', [BookController::class, 'count']);
        Route::get('/avg-pages', [BookController::class, 'avgPages']);
    });

    Route::get('/dashboard', [BookController::class, 'dashboard']);
});

Route::prefix('relationsheep')->group(function () {
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/topics/{slug}/posts', [TopicController::class, 'posts']);
    Route::get('/tags/{tagSlug}/posts', [TagController::class, 'posts']);
});

Route::prefix('ackerer')->group(function () {
    Route::get('/plants', [PlantController::class, 'index']);
    Route::get('/plants/{slug}', [PlantController::class, 'show']);
    Route::get('/areas', [AreaController::class, 'index']);
});

Route::prefix('k-rest-y')->group(function () {
    Route::get('/clowns', [ClownController::class, 'index']);
    Route::get('/clowns/{clown}', [ClownController::class, 'show'])->whereNumber('clown');
    Route::post('/clowns', [ClownController::class, 'store']);
    Route::match(['put', 'patch'], '/clowns/{clown}', [ClownController::class, 'update'])->whereNumber('clown');
    Route::delete('/clowns/{clown}', [ClownController::class, 'destroy'])->whereNumber('clown');
});

