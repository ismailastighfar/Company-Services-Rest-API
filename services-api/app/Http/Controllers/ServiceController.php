<?php

namespace App\Http\Controllers;
use App\DTOs\ServiceDTO;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Interfaces\ServiceServiceInterface;
use Illuminate\Support\Facades\Log;
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
     *     description="Returns a list of services based on the API key. You can sort, paginate, and select specific fields.",
     *     operationId="index",
     *     tags={"Services"},
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="Field to sort the results by.",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="direction",
     *         in="query",
     *         description="Sorting direction. 'asc' for ascending, 'desc' for descending.",
     *         required=false,
     *         @OA\Schema(type="string", enum={"asc", "desc"})
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page.",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="fields",
     *         in="query",
     *         description="Comma-separated list of fields to be returned in the response.",
     *         required=false,
     *         @OA\Schema(type="string",format="csv")
     *     ),
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
        $sortField = request()->input('sort', 'id');
        $sortDirection = request()->input('direction', 'asc');
        $perPage = request()->input('per_page', 10);
        $selectedFields = request()->input('fields', '');


        $services = $this->serviceService->getAllServices($authorizationHeader,$selectedFields,$sortField,$sortDirection,$perPage);



        return response()->ok(ServiceResource::collection($services));
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

        return response()->created(new ServiceResource($service));
    }


}
