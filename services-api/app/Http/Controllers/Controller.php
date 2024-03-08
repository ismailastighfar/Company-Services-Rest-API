<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="Services API",
 *     version="1.0.0",
 *     description="API to manage services in a company",
 *     @OA\Contact(
 *         email="astighfar2000@gmail.com",
 *         name="Astighfar Ismail"
 *     )
 * )
 */


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
