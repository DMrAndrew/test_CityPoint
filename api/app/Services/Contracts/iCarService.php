<?php

namespace App\Services\Contracts;

use App\Models\Car;

interface iCarService extends iService
{
    /**
     * @param array $params
     * @return mixed
     */
    public static function get($params = []);
    /**
     * @param array $payload
     * @return Car
     */
    public static function create($payload);
}