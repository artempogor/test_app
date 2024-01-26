<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Api Documentation",
 *     description="Api Documentation",
 *     @OA\Contact(
 *         name="Artem Pogorelov",
 *         email="artem1278495@gmail.com"
 *     ),
 * ),
 * @OA\Server(
 *     url="/api",
 * ),
 * @OA\SecurityScheme(
 *       securityScheme="bearerAuth",
 *       in="header",
 *       name="Authorization",
 *       type="http",
 *       scheme="Bearer",
 *       bearerFormat="JWT",
 *  ),
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
