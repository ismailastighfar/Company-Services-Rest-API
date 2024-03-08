<?php

namespace App\Http\Controllers;
use OpenApi\Annotations as OA;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     securityScheme="bearerAuth",
 *     name="Authorization",
 *     description="Enter 'Bearer [api key]' as the value."
 * )
 */
class ServiceController extends Controller
{


    /**
     * @OA\Get(
     *     path="/api/services",
     *     summary="Get a list of services",
     *     description="Returns a list of services based on the API key",
     *     operationId="index",
     *     tags={"Services"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Service")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized. Invalid API key",
     *         @OA\JsonContent(
     *             example={"error": "Unauthorized. Invalid API key."}
     *         )
     *     )
     * )
     */
    public function index()
    {
        $authorizationHeader = request()->header('Authorization');
        $apiKey = substr($authorizationHeader, 7);
        $apiKeysConfig = Config::get('apiFields.api_keys');

        if (!isset($apiKeysConfig[$apiKey])) {
            return response()->json(['error' => 'Unauthorized. Invalid API key.'], 401);
        }

        $associatedFields = $apiKeysConfig[$apiKey];
        $services = Service::all($associatedFields);

        return response()->json(['data' => $services], 200);
    }


    /**
     * @OA\Post(
     *     path="/api/services",
     *     summary="Create a new service",
     *     description="Creates a new service with the provided data",
     *     operationId="store",
     *     tags={"Services"},
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Service data",
     *         @OA\JsonContent(ref="#/components/schemas/Service")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Service created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", ref="#/components/schemas/Service")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", ref="#/components/schemas/ValidationError")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:25',
            'description' => 'required',
            'price' => 'required|numeric',
            'is_active' => 'required|boolean',
            'location' => 'required|max:25',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $service = Service::create($request->all());

        return response()->json(['data' => $service], 201);
    }


}
