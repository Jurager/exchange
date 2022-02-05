<?php

$path = config('exchange.path', 'exchange');

Route::group(['middleware' => [\Illuminate\Session\Middleware\StartSession::class]], function () use ($path) {
    Route::match(['get', 'post'], $path, Jurager\Exchange\Controller\ImportController::class.'@request');
});
