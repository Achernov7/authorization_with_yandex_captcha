<?php

use rmvc\vc\Route\Route;
use App\http\Controllers\Authentication\Authentication;
use App\http\Controllers\Person\Person;

Route::post('/auth/create', [Authentication::class, 'create']);
Route::post('/auth/login', [Authentication::class, 'login']);
Route::post('/profile/store', [Person::class, 'store']);
Route::get('/auth/logout', [Authentication::class, 'logout']);
