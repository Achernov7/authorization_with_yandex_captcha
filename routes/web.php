<?php


use rmvc\vc\Route\Route;
use App\http\Controllers\Person\Person;
use App\http\Controllers\Outsider\Outsider;
use App\http\Controllers\Authentication\Authentication;

Route::get('/', [Outsider::class, 'index']);
Route::get('/login', [Authentication::class, 'showlogin']);
Route::get('/registration', [Authentication::class, 'showRegister']);
Route::get('/user/personal', [Person::class, 'show']);