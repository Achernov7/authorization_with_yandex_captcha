<?php

namespace App\http\Controllers\Person;

use rmvc\vc\DB\DB;
use rmvc\vc\Facades\Session;
use rmvc\vc\Facades\Response;
use rmvc\vc\Service\Auth\Auth;
use rmvc\vc\Response\View\View;
use rmvc\vc\Controller\Controller;
use App\http\Requests\Profile\PostRequest;

class Person extends Controller
{
    public function show()
    {
        if (Session::get('auth')) {
            $user = Auth::user();
            return View::view('person.show', compact('user'));
        }
        return Response::redirect('/');
    }

    public function store(PostRequest $request)
    {

        if (!Session::get('auth')) {
            return Response::json('Unauthorized', 401);
        }

        $data = $request::validated();

        $data['updated_at'] = date('Y-m-d H:i:s');

        $data['id'] = Session::get('auth_id');

        if (isset($data['password_new'])) {
            $data['password'] = password_hash($data['password_new'], PASSWORD_BCRYPT);
            unset($data['password_new']);
            DB::query('UPDATE users SET PASSWORD = :password, UPDATED_AT = :UPDATED_AT, NAME = :name, EMAIL = :email, PHONE = :phone WHERE id = :id', ['password' => $data['password'], 'UPDATED_AT' => $data['updated_at'], 'name' => $data['name'], 'email' => $data['email'], 'phone' => $data['phone'], 'id' => $data['id']]);
        } else {
            DB::query('UPDATE users SET NAME = :name, EMAIL = :email, PHONE = :phone WHERE id = :id', ['name' => $data['name'], 'email' => $data['email'], 'phone' => $data['phone'], 'id' => $data['id']]);
        }

        return Response::json(['message' => 'Successfully updated'], 200);
    }
}