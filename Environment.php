<?php

namespace App;

class Environment
{
    public static function get()
    {
        return [
            "DB_HOST" => "localhost",
            "DB_USER" => "postgres",
            "DB_PASS" => "Rocky007.",
            "DB_NAME" => "Blog",
            "DB_PORT" => "5432",
        ];
    }
}
