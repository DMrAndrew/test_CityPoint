<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Http\Resources\CarCollection;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Services\CarService;
use App\Services\Contracts\iCarService;

class CarController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(iCarService $service)
    {
        //TODO paginate
        return CarCollection::make($service::get())
            ->toResponse(request());
    }

    /**
     * @param  Car  $car
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Car $car)
    {
        return CarResource::make($car)
            ->toResponse(request());
    }

    /**
     * @param  CarRequest  $request
     * @param  CarService  $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CarRequest $request, iCarService $service)
    {
        return CarResource::make($service::create($request->validated()))
            ->toResponse($request)
            ->setStatusCode(201);
    }
}
