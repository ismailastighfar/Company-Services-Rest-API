<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentResource;
use App\Interfaces\DepartmentServiceInterface;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    use APIResponseTrait;
    protected DepartmentServiceInterface $departmentService;

    public function __construct(DepartmentServiceInterface $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    /**
     * @OA\Get(
     *     path="/api/departments",
     *     summary="Get a list of departments",
     *     description="Returns a list of departments.",
     *     operationId="getDepartments",
     *     tags={"Departments"},
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
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Department")
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

    public function index(Request $request)
    {
        $sortField = $request->input('sort', 'id');
        $sortDirection = $request->input('direction', 'asc');
        $perPage = $request->input('per_page', 10);

        $departments = $this->departmentService->all($sortField, $sortDirection, $perPage);

        return $this->ok(DepartmentResource::collection($departments));
    }
}
