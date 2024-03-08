<?php

namespace Database\Seeders;

use App\Models\APIKey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class APIKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apiKeys = [
            '3e5d69ea-078e-321f-a742-b7bd6921cb28',
            '8bc5b6fa-2fb9-3865-89a8-f14b65480097',
            'c14d64fb-49be-3ca4-8cf5-046c6e39eb97',
            'ce7d1adc-d90e-3cb1-b940-021a8594bf2d',
            'f003a16b-ad5a-3e5b-afa0-45586cda29ba',
        ];

        foreach ($apiKeys as $apiKey) {
            ApiKey::create([
                'key' => $apiKey,
            ]);
        }
    }
}
