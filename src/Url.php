<?php

namespace App;

class Url
{
    public const BASE_URL = 'http://localhost/e-comercee/';
    public static function link($path)
    {
        return rtrim(Url::BASE_URL, '/') . '/' . $path;
    }
}
