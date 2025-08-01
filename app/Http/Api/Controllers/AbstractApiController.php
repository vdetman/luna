<?php

namespace App\Http\Api\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Middleware\ApiAccessMiddleware;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "Luna REST API",
)]
#[OA\SecurityScheme(
    securityScheme: "bearerAuth",
    type: "apiKey",
    name: "x-api-token",
    in: 'header',
    scheme: "bearer"
)]
#[OA\Schema(
    schema: "ErrorResponse",
    properties: [
        new OA\Property(property: "status", type: "boolean", example: false),
        new OA\Property(property: "error", type: "string", example: "Описание ошибки"),
        new OA\Property(property: "errors", type: "object", nullable: true)
    ]
)]
#[OA\Schema(
    schema: "RBuilding",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "address", type: "string", example: "ул. Тверская, 1"),
        new OA\Property(property: "latitude", type: "number", format: "float", example: 55.7558),
        new OA\Property(property: "longitude", type: "number", format: "float", example: 37.6176),
    ]
)]
#[OA\Schema(
    schema: "ROrganizationPhone",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "phone", type: "string", example: "+7 (495) 123-45-67"),
    ]
)]
#[OA\Schema(
    schema: "RActivity",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "name", type: "string", example: "Еда"),
        new OA\Property(property: "level", type: "integer", example: 1),
        new OA\Property(property: "parent_id", type: "integer", example: null, nullable: true),
    ]
)]
abstract class AbstractApiController extends Controller
{
    public function __construct()
    {
        $this->middleware([ApiAccessMiddleware::class]);
    }
}
