<?php

namespace App\Http\Controllers;
use App\DTOs\ServiceDTO;
use App\Http\Requests\ServiceRequest;
use App\Interfaces\ServiceServiceInterface;
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
    private ServiceServiceInterface $serviceService;

    public function __construct(ServiceServiceInterface $serviceService)
    {
        $this->serviceService = $serviceService;
    }

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
        $services = $this->serviceService->getAllServices($authorizationHeader);

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
    public function store(ServiceRequest $request)
    {
        $serviceDTO = new ServiceDTO($request->validated());

        $service = $this->serviceService->createService($serviceDTO);

        return response()->json(['data' => $service], 201);
    }


}
