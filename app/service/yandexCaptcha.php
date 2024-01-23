<?php

namespace App\service;

use rmvc\vc\Config\Config;

class yandexCaptcha
{
    private function curl_captcha($token) {
        $ch = curl_init();
        $args = http_build_query([
            "secret" => Config::get('captcha.connections.backend'),
            "token" => $token,
            "ip" => $_SERVER['REMOTE_ADDR']
        ]);
        curl_setopt($ch, CURLOPT_URL, "https://smartcaptcha.yandexcloud.net/validate?$args");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2);
    
        $server_output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        if ($httpcode !== 200) {
            echo "Allow access due to an error: code=$httpcode; message=$server_output\n";
            return false;
        }

        $resp = json_decode($server_output);
        if ($resp->status !== "ok") {
            return false;
        } else {
            return true;
        }
    }

    public function check_captcha($token) {
        return $this->curl_captcha($token); 
    }
}