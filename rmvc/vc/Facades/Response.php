<?php
namespace rmvc\vc\Facades;

use rmvc\vc\Response\Json\Json;
use rmvc\vc\Response\View\View;
use rmvc\vc\Route\Route;

class Response
{
    public static function json($data, int $statusCode = null, $statusText = null)
    {
        self::sendStatusCode($statusCode, $statusText);
        
        return Json::json($data);
    }

    public static function view(string $str, array $data = []): string
    {
        return View::view($str, $data);
    }

    public static function redirect($url)
    {
        Route::redirect($url);
    }

    public static function sendStatusCode(int $code = null, ?string $text = null)
    {

        $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

        if ($code !== NULL) {
            
            switch ($code) {
                case 100: $text = $text ?? 'Continue'; break;
                case 101: $text = $text ?? 'Switching Protocols'; break;
                case 200: $text = $text ?? 'OK'; break;
                case 201: $text = $text ?? 'Created'; break;
                case 202: $text = $text ?? 'Accepted'; break;
                case 203: $text = $text ?? 'Non-Authoritative Information'; break;
                case 204: $text = $text ?? 'No Content'; break;
                case 205: $text = $text ?? 'Reset Content'; break;
                case 206: $text = $text ?? 'Partial Content'; break;
                case 300: $text = $text ?? 'Multiple Choices'; break;
                case 301: $text = $text ?? 'Moved Permanently'; break;
                case 302: $text = $text ?? 'Moved Temporarily'; break;
                case 303: $text = $text ?? 'See Other11'; break;
                case 304: $text = $text ?? 'Not Modified'; break;
                case 305: $text = $text ?? 'Use Proxy'; break;
                case 400: $text = $text ?? 'Bad Request'; break;
                case 401: $text = $text ?? 'Unauthorized'; break;
                case 402: $text = $text ?? 'Payment Required'; break;
                case 403: $text = $text ?? 'Forbidden'; break;
                case 404: $text = $text ?? 'Not Found'; break;
                case 405: $text = $text ?? 'Method Not Allowed'; break;
                case 406: $text = $text ?? 'Not Acceptable'; break;
                case 407: $text = $text ?? 'Proxy Authentication Required'; break;
                case 408: $text = $text ?? 'Request Time-out'; break;
                case 409: $text = $text ?? 'Conflict'; break;
                case 410: $text = $text ?? 'Gone'; break;
                case 411: $text = $text ?? 'Length Required'; break;
                case 412: $text = $text ?? 'Precondition Failed'; break;
                case 413: $text = $text ?? 'Request Entity Too Large'; break;
                case 414: $text = $text ?? 'Request-URI Too Large'; break;
                case 415: $text = $text ?? 'Unsupported Media Type'; break;
                case 422: $text = $text ?? 'Unprocessable Entity'; break;
                case 500: $text = $text ?? 'Internal Server Error'; break;
                case 501: $text = $text ?? 'Not Implemented'; break;
                case 502: $text = $text ?? 'Bad Gateway'; break;
                case 503: $text = $text ?? 'Service Unavailable'; break;
                case 504: $text = $text ?? 'Gateway Time-out'; break;
                case 505: $text = $text ?? 'HTTP Version not supported'; break;
                default:
                    exit('Unknown http status code "' . htmlentities($code) . '"');
                break;
            }

            header($protocol . ' ' . $code . ' ' . $text);

            $GLOBALS['http_response_code'] = $code;

        } else {

            $code = (isset($GLOBALS['http_response_code']) ? $GLOBALS['http_response_code'] : 200);

        }
        
        return $code;
    }

}