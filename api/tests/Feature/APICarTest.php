<?php

namespace Tests\Feature;

use App\Models\Car;
use Tests\TestCase;

class APICarTest extends TestCase
{

    protected $api = '/api';

    protected $carStructure = [
        'Id',
        'RegNumber',
        'VIN',
        'Model',
        'Brand'
    ];

    public function test_index()
    {
        $response = $this->get($this->api.'/cars', $this->jsonHeaders());

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => $this->carStructure
                ],
                'meta' => [
                    'total_count'
                ]
            ]);
    }

    public function test_store()
    {
        $response = $this->storeResponse(Car::factory()->make()->toArray());

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'data' => $this->carStructure
        ]);
    }

    public function test_store_validation()
    {
        $make = fn() => Car::factory()->make()->toArray();

        $data = $make();
        unset($data['VIN']);

        $this->assertStoreValidation($data)
            ->assertJsonStructure([
                'errors' => [
                    'data.VIN'
                ]
            ]);
        // ...
    }

    protected function assertStoreValidation($data)
    {
        return $this->assertValidation($this->storeResponse($data));
    }

    protected function assertValidation($response)
    {
        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors'
            ]);
        return $response;
    }

    protected function storeResponse($data)
    {
        return $this->json('post',
            $this->api.'/cars',
            [
                'data' => $data
            ],
            $this->jsonHeaders()
        );
    }

    protected function jsonHeaders()
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

}