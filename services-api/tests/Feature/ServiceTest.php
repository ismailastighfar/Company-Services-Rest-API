<?php

namespace Tests\Feature;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceTest extends TestCase
{


    public function test_services_list_has_expected_structure()
    {

        Service::factory()->count(5)->create();

        $apiKey = "3e5d69ea-078e-321f-a742-b7bd6921cb28";

        $response = $this->withHeaders(['Authorization' => "Bearer $apiKey"])
            ->getJson('/api/services');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'description'
                ],
            ],
        ]);
    }

    public function test_store_new_service_successfully_created()
    {

        $apiKey = '3e5d69ea-078e-321f-a742-b7bd6921cb28';
        $this->withHeaders(['Authorization' => "Bearer $apiKey"]);

        $requestData = [
            'name' => 'Test Service',
            'description' => 'This is a test service',
            'price' => 19.99,
            'is_active' => true,
            'location' => 'Test Location',
            'contact_email' => 'test@example.com',
            'contact_phone' => '1234567890'
        ];

        $response = $this->postJson('/api/services', $requestData);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'description',
                'price',
                'is_active',
                'location',
                'contact_email',
                'contact_phone',
            ],
        ]);

        // Assert that the data created is returned in the response
        $response->assertJsonFragment($requestData);

        // assert the data in the database
        $this->assertDatabaseHas('services', $requestData);
    }



    public function test_store_new_service_Validation_Errors()
    {

        $apiKey = '3e5d69ea-078e-321f-a742-b7bd6921cb28';
        $this->withHeaders(['Authorization' => "Bearer $apiKey"]);


        $invalidData = [
            'name' => str_repeat('a', 26), // Exceeds maximum length
            'description' => 'test', // Required field
            'price' => 'invalid_price', // Invalid numeric value
            'is_active' => 'invalid_boolean', // Invalid boolean value
            'location' => '', // Required field
            'contact_email' => 'invalid_email', // Invalid email format
            'contact_phone' => str_repeat('1', 11), // Exceeds maximum length
        ];

        $response = $this->postJson('/api/services', $invalidData);

        $response->assertStatus(422);

        // Assert the expected validation errors in the response
        $response->assertJsonValidationErrors([
            'name',
            'price',
            'is_active',
            'location',
            'contact_email',
            'contact_phone',
        ]);
    }


    public function test_Invalid_Api_Key_Format()
    {
        $invalidApiKey = '3e5d69ea-078e-321f-a742-b7bd6921cb28';
        $this->withHeaders(['Authorization' => $invalidApiKey]);

        $response = $this->get('/api/services');

        $response->assertStatus(401);

        $response->assertJson(['message' => 'Unauthorized. Invalid Authorization header format.']);
    }


    public function test_Invalid_Api_Key()
    {
        $invalidApiKey = 'invalid_api_key';
        $this->withHeaders(['Authorization' => "Bearer $invalidApiKey"]);

        $response = $this->get('/api/services');

        $response->assertStatus(401);

        $response->assertJson(['message' => 'Unauthorized. Invalid API key.']);
    }


}
