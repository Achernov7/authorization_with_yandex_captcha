<?php

namespace App\http\Requests\Auth\Registration;

use rmvc\vc\Facades\Request;

class PostRequest extends Request
{
    public static function rules(): array
    {
        return [
            'name' => 'required|string|max:15|min:3|notNull|unique:users.name',
            'phone' => 'required|phone|notNull|max:12|unique:users.phone',
            'email' => 'required|email|notNull|max:25|unique:users.email',
            'password' => 'required|string|min:6|notNull',
            'password_confirm' => 'required|same:password',
        ];
    }
}