<?php

namespace App\http\Requests\Auth\Login;

use rmvc\vc\Facades\Request;

class PostRequest extends Request
{
    public static function rules(): array
    {
        return [
            'smartToken' => 'required|notNull',
            'login' => 'required|string|max:25|notNull',
            'password' => 'required|string|min:6|notNull',
        ];
    }
}