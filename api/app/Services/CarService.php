<?php

namespace App\Services;

use App\Models\Car;
use App\Services\Contracts\iCarService;

class CarService implements iCarService
{
    /**
     * @param array $payload
     * @return Car
     */
    public static function create($payload)
    {
        return Car::create($payload)->fresh();
    }

    public static function get($params = [])
    {
        return Car::all();
    }
}