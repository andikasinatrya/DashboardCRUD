<?php

use App\Services\HobbyGenerator;
use Illuminate\Foundation\Application;
use Illuminate\Console\Scheduling\Schedule;
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
    })->withSchedule(function(Schedule $schedule) {
        $schedule->command('hobby:generator')->everyMinute();
        $schedule->command('app:migrate')->everyFiveMinutes();
        $schedule->command('app:seed')->everyFiveMinutes();
        // $schedule->call(new HobbyGenerator)->everyMinute();
    })->create();
