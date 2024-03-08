<?php

namespace App\Http\Middleware;

use App\Models\APIKey;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckApiKey
{
    public function handle(Request $request, Closure $next): Response
    {

        $authorizationHeader = $request->header('Authorization');


        Log::info('Received Authorization header: ' . $authorizationHeader);

        // Check if the Authorization header is present and has the expected format
        if (!$authorizationHeader || !str_starts_with($authorizationHeader, 'Bearer ')) {
            return response()->json(['error' => 'Unauthorized. Invalid Authorization header format.'], 401);
        }

        // Remove "Bearer " prefix to get the actual API key
        $apiKey = substr($authorizationHeader, 7);


        Log::info('Extracted API key: ' . $apiKey);


        if (!$this->isValidApiKey($apiKey)) {
            return response()->json(['error' => 'Unauthorized. Invalid API key.'], 401);
        }


        return $next($request);
    }

    private function isValidApiKey($apiKey)
    {
        return ApiKey::where('key', $apiKey)->exists();
    }

}
