<?php

namespace App\http\Requests\Profile;

use rmvc\vc\Facades\Request;

class PostRequest extends Request
{
    public static function rules():array
    {
        return [
            'name' => 'required|string|max:15|min:3|notNull',
            'phone' => 'required|phone|notNull|max:12',
            'email' => 'required|email|notNull|max:25',
            'password_new' => 'string|min:6|notNull',
            'password_old' => 'same:password_new',
        ];
    }
}