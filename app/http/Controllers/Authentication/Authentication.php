<?php

namespace App\http\Controllers\Authentication;

use App\http\Gates\yandexCaptchaGate;
use rmvc\vc\DB\DB;
use rmvc\vc\Facades\Session;
use rmvc\vc\Facades\Response;
use rmvc\vc\Response\View\View;
use rmvc\vc\Controller\Controller;
use App\service\checkNumberOfEmail;
use App\http\Requests\Auth\Login\PostRequest;
use App\http\Requests\Auth\Registration\PostRequest as PostRequestRegister;
use rmvc\vc\Config\Config;

class Authentication extends Controller
{
    public function showLogin()
    {    
        if (Session::get('auth')) {
            return Response::redirect('/');
        }
        $frontKey = Config::get('captcha.connections.frontend');

        return View::view('auth.login', compact('frontKey'));
    }

    public function showRegister()
    {
        if (Session::get('auth')) {
            return Response::redirect('/');
        }
        return View::view('auth.registration');
    }

    public function create(PostRequestRegister $request)
    {
        $data = $request::validated();

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        DB::query('INSERT INTO USERS (NAME, PHONE, EMAIL, PASSWORD) VALUES (:name, :phone, :email, :password)', ['name' => $data['name'], 'phone' => $data['phone'], 'email' => $data['email'], 'password' => $data['password']]);

        Session::setUser(DB::lastInsertId());

        return Response::json(['message' => 'Successfully registered'], 200);
    }

    public function login(PostRequest $request)
    {
        $data = $request::validated();

        $login = checkNumberOfEmail::check($data['login']);
        
        if ($login['type'] == 'phone') {
            $user = DB::query('SELECT * FROM USERS WHERE PHONE = :phone LIMIT 1', ['phone' => $login['value']]);
        } elseif ($login['type'] == 'email') {
            $user = DB::query('SELECT * FROM USERS WHERE EMAIL = :email LIMIT 1', ['email' => $login['value']]);
        } else {
            return Response::json('Login has wrong format', 401);
        }
        
        if ($user == null) {
            return Response::json('User not found', 401);
        }

        if (!password_verify($data['password'], $user[0]['PASSWORD'])) {
            return Response::json('Wrong password', 401);
        }

        $captcha = $this->authorize(yandexCaptchaGate::class, $data['smartToken']);

        Session::setUser($user[0]['ID']);

        return Response::json('Successfully logged in', 200); 
    }

    public function logout()
    {
        if (Session::has('auth')) {
            session_unset();
            session_destroy();
            session_start();
            session_regenerate_id(true);
        } else {
            return Response::json(['message' => 'Not logged in'], 401);
        }
        return Response::json(['message' => 'Successfully logged out'], 200);
    }
}