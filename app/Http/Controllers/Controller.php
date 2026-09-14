<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "TastyIgniter API Documentation",
    description: "API Documentation for TastyIgniter Application",
    contact: new OA\Contact(email: "admin@tastyigniter.com")
)]
#[OA\Server(
    url: "/api",
    description: "TastyIgniter API Server Base"
)]
#[OA\SecurityScheme(
    securityScheme: "bearerAuth",
    type: "http",
    scheme: "bearer",
    bearerFormat: "Sanctum Token"
)]
#[OA\PathItem(
    path: "/token",
    summary: "Generate API Token",
    post: new OA\Post(
        path: "/token",
        summary: "Generate API Access Token",
        description: "Generate Sanctum bearer token for customer or admin",
        tags: ["Authentication"],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "email", type: "string", example: "customer@example.com"),
                    new OA\Property(property: "password", type: "string", example: "secret"),
                    new OA\Property(property: "device_name", type: "string", example: "my_mobile_app"),
                    new OA\Property(property: "is_admin", type: "integer", example: 0)
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Token generated successfully",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "status_code", type: "integer", example: 201),
                        new OA\Property(property: "token", type: "string", example: "1|abc123xyz...")
                    ]
                )
            ),
            new OA\Response(response: 401, description: "Unauthenticated")
        ]
    )
)]
#[OA\PathItem(
    path: "/menus",
    summary: "Menus API",
    get: new OA\Get(
        path: "/menus",
        summary: "List Menus",
        description: "Retrieve list of menu items",
        tags: ["Menus"],
        responses: [
            new OA\Response(response: 200, description: "Successful response")
        ]
    )
)]
#[OA\PathItem(
    path: "/categories",
    summary: "Categories API",
    get: new OA\Get(
        path: "/categories",
        summary: "List Categories",
        description: "Retrieve list of menu categories",
        tags: ["Categories"],
        responses: [
            new OA\Response(response: 200, description: "Successful response")
        ]
    )
)]
#[OA\PathItem(
    path: "/locations",
    summary: "Locations API",
    get: new OA\Get(
        path: "/locations",
        summary: "List Locations",
        description: "Retrieve list of restaurant locations",
        tags: ["Locations"],
        responses: [
            new OA\Response(response: 200, description: "Successful response")
        ]
    )
)]
#[OA\PathItem(
    path: "/orders",
    summary: "Orders API",
    get: new OA\Get(
        path: "/orders",
        summary: "List Orders",
        description: "Retrieve list of customer or admin orders",
        security: [["bearerAuth" => []]],
        tags: ["Orders"],
        responses: [
            new OA\Response(response: 200, description: "Successful response")
        ]
    )
)]
#[OA\PathItem(
    path: "/reservations",
    summary: "Reservations API",
    get: new OA\Get(
        path: "/reservations",
        summary: "List Reservations",
        description: "Retrieve list of table reservations",
        security: [["bearerAuth" => []]],
        tags: ["Reservations"],
        responses: [
            new OA\Response(response: 200, description: "Successful response")
        ]
    )
)]
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

