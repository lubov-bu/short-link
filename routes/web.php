<?php

use App\Http\Controllers\LinkController;
use App\Http\Middleware\TokenCheckMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/{shortLink}', [LinkController::class, 'getOriginalLink'])->middleware(TokenCheckMiddleware::class);
