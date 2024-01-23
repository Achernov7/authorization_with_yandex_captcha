<?php

namespace rmvc\vc\Response\Json;

class Json
{
    public static function json($data)
    {
        return json_encode($data);
    }
}