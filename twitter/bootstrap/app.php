<?php

// PHP 8.5 meldet PDO::MYSQL_ATTR_SSL_CA (config/database.php) als deprecated.
// Die Config wird vor Laravels Error-Handler geladen, darum landet die Meldung
// sonst direkt im Output (und in JSON-API-Antworten). E_DEPRECATED hier ausblenden,
// bevor LoadConfiguration laeuft; echte Fehler und Warnungen bleiben sichtbar.
error_reporting(error_reporting() & ~(E_DEPRECATED | E_USER_DEPRECATED));

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
