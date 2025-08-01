<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Resources\Activities\RActivityTree;
use App\Modules\Activities\ActivityModule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Throwable;

#[OA\Tag(name: "Activities", description: "Работа с видами деятельности")]
class ActivitiesController extends AbstractApiController
{
    #[OA\Get(
        path: "/api/activities",
        operationId: "api.activities.list",
        description: "Возвращает все виды деятельности, организованные в иерархическую структуру дерева",
        summary: "Получение списка всех видов деятельности в виде дерева",
        security: [["bearerAuth" => []]],
        tags: ["Activities"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Дерево видов деятельности",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'status', type: 'boolean', example: true),
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(ref: '#/components/schemas/RActivityTree'),
                            example: [
                                [
                                    'id' => 1,
                                    'name' => 'Разработка',
                                    'parent_id' => null,
                                    'children' => [
                                        [
                                            'id' => 2,
                                            'name' => 'Frontend разработка',
                                            'parent_id' => 1,
                                            'children' => []
                                        ],
                                        [
                                            'id' => 3,
                                            'name' => 'Backend разработка',
                                            'parent_id' => 1,
                                            'children' => []
                                        ]
                                    ]
                                ]
                            ]
                        ),
                        new OA\Property(property: 'message', type: 'string', example: 'Дерево видов деятельности получено успешно')
                    ]
                )
            )
        ]
    )]
    public function list(Request $request): JsonResponse
    {
        try {
            $tree = ActivityModule::getTree();

            return response()->json([
                'status' => true,
                'list' => RActivityTree::collection($tree)->toArray($request)
            ]);
        } catch (Throwable) {
            return response()->json([
                'status' => false,
                'error' => 'Произошла ошибка при получении дерева видов деятельности'
            ]);
        }
    }
}
