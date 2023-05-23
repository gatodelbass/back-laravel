<?php

namespace App\Traits;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

trait SetClient
{
    public function setCliente($clientepath)
    {
        Config::set("database.connections.mysql", [
            'driver' => 'mysql',
            "host" => env("DB_HOST"),
            "database" => "caudata_" . $clientepath,
            "username" => env("DB_USERNAME_CAUDATA"),
            "password" => env("DB_PASSWORD_CAUDATA"),
            "port" => env("DB_PORT"),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ]);
        DB::reconnect('mysql');
    }
}
