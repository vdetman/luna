<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Requests\Organizations\OrganizationGetByLocationFormRequest;
use App\Http\Api\Requests\Organizations\OrganizationSearchByNameFormRequest;
use App\Http\Api\Resources\Organizations\ROrganization;
use App\Http\Api\Resources\Organizations\ROrganizationCollection;
use App\Modules\Activities\ActivityModule;
use App\Modules\Activities\Exceptions\ActivityNotFoundException;
use App\Modules\Buildings\BuildingModule;
use App\Modules\Buildings\Enums\LocationSearchTypeEnum;
use App\Modules\Buildings\Exceptions\BuildingNotFoundException;
use App\Modules\Organizations\Exceptions\OrganizationNotFoundException;
use App\Modules\Organizations\OrganizationModule;
use App\Modules\Organizations\Requests\OrganizationGetByLocationRequestDto;
use App\Modules\Organizations\Requests\OrganizationListRequestDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Throwable;

#[OA\Tag(
    name: "Organizations",
    description: "API для работы с организациями"
)]
class OrganizationsController extends AbstractApiController
{
    #[OA\Get(
        path: "/api/organizations/get/{id}",
        operationId: "api.organizations.get",
        description: "Возвращает подробную информацию об организации по её идентификатору",
        summary: "Получить информацию об организации",
        security: [["bearerAuth" => []]],
        tags: ["Organizations"]
    )]
    #[OA\Parameter(
        name: "id",
        description: "ID организации",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer", example: 1)
    )]
    #[OA\Response(
        response: 200,
        description: "Информация об организации",
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "status", type: "boolean", example: true),
                new OA\Property(property: "data", ref: "#/components/schemas/ROrganization")
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: "Организация не найдена",
        content: new OA\JsonContent(ref: "#/components/schemas/ErrorResponse")
    )]
    public function getById(int $id): JsonResponse
    {
        try {
            $organization = OrganizationModule::getRequiredById($id);
            $organization->load([
                'building',
                'phones',
                'activities',
            ]);

            return response()->json([
                'status' => true,
                'data' => new ROrganization($organization),
            ]);

        } catch (OrganizationNotFoundException) {
            return response()->json([
                'status' => false,
                'error' => 'Организация не найдена'
            ], 404);
        } catch (Throwable) {
            return response()->json([
                'status' => false,
                'error' => 'Произошла ошибка'
            ], 500);
        }
    }

    #[OA\Get(
        path: "/api/organizations/by-building/{buildingId}",
        operationId: "api.organizations.by_building",
        description: "Возвращает список всех организаций, находящихся в конкретном здании",
        summary: "Получить список организаций в здании",
        security: [["bearerAuth" => []]],
        tags: ["Organizations"]
    )]
    #[OA\Parameter(
        name: "buildingId",
        description: "ID здания",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer", example: 1)
    )]
    #[OA\Response(
        response: 200,
        description: "Список организаций в здании",
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'boolean', example: true),
                new OA\Property(property: 'data', ref: '#/components/schemas/ROrganization')
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: "Здание не найдено",
        content: new OA\JsonContent(ref: "#/components/schemas/ErrorResponse")
    )]
    public function getByBuilding(Request $request, int $buildingId): JsonResponse
    {
        try {
            $building = BuildingModule::getRequiredById($buildingId);
            $building->load([
                'organizations',
                'organizations.building',
                'organizations.phones',
                'organizations.activities',
            ]);

            return response()->json([
                'status' => true,
                'data' => (new ROrganizationCollection($building->organizations))->toArray($request)
            ]);

        } catch (BuildingNotFoundException) {
            return response()->json([
                'status' => false,
                'error' => 'Здание не найдено'
            ], 404);
        } catch (Throwable) {
            return response()->json([
                'status' => false,
                'error' => 'Произошла ошибка'
            ], 500);
        }
    }

    #[OA\Get(
        path: "/api/organizations/by-activity/{activityId}",
        operationId: "api.organizations.by_activity",
        description: "Возвращает список всех организаций, которые относятся к указанному виду деятельности",
        summary: "Получить список организаций по виду деятельности",
        security: [["bearerAuth" => []]],
        tags: ["Organizations"]
    )]
    #[OA\Parameter(
        name: "activityId",
        description: "ID вида деятельности",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer", example: 1)
    )]
    #[OA\Response(
        response: 200,
        description: "Список организаций по виду деятельности",
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'boolean', example: true),
                new OA\Property(property: 'data', ref: '#/components/schemas/ROrganization')
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: "Вид деятельности не найден",
        content: new OA\JsonContent(ref: "#/components/schemas/ErrorResponse")
    )]
    public function getByActivity(Request $request, int $activityId): JsonResponse
    {
        try {
            $activity = ActivityModule::getRequiredById($activityId);
            $activity->load([
                'organizations',
                'organizations.building',
                'organizations.phones',
                'organizations.activities',
            ]);

            return response()->json([
                'status' => true,
                'data' => (new ROrganizationCollection($activity->organizations))->toArray($request)
            ]);

        } catch (ActivityNotFoundException) {
            return response()->json([
                'status' => false,
                'error' => 'Вид деятельности не найден'
            ], 404);
        } catch (Throwable) {
            return response()->json([
                'status' => false,
                'error' => 'Произошла ошибка'
            ], 500);
        }
    }

    #[OA\Get(
        path: "/api/organizations/by-location",
        description: "Возвращает список организаций, которые находятся в заданном радиусе или прямоугольной области относительно указанной точки на карте",
        summary: "Получить список организаций по местоположению",
        security: [["bearerAuth" => []]],
        tags: ["Organizations"],
        parameters: [
            new OA\Parameter(name: 'latitude', description: 'Широта центральной точки', in: 'query', required: true,
                schema: new OA\Schema(type: "number", format: "float", example: 55.7558)
            ),
            new OA\Parameter(name: 'longitude', description: 'Долгота центральной точки', in: 'query', required: true,
                schema: new OA\Schema(type: "number", format: "float", example: 37.6176)
            ),
            new OA\Parameter(name: 'type', description: 'Тип поиска. Круг или квадрат', in: 'query', required: true,
                schema: new OA\Schema(enum: ['circle', 'square'], example: 'circle'),
            ),
            new OA\Parameter(name: 'radius', description: 'Радиус поиска в метрах (используется, если type == circle)', in: 'query',
                schema: new OA\Schema(type: "number", format: "integer", example: 1000)
            ),
            new OA\Parameter(name: 'width', description: 'Ширина квадрата в метрах (используется, если type == square)', in: 'query',
                schema: new OA\Schema(type: "number", format: "integer", example: 1000)
            ),
        ],
    )]
    #[OA\Response(
        response: 200,
        description: "Список организаций по местоположению",
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'boolean', example: true),
                new OA\Property(property: 'data', ref: '#/components/schemas/ROrganization')
            ]
        )
    )]
    public function getByLocation(OrganizationGetByLocationFormRequest $request): JsonResponse
    {
        try {
            $dto = (new OrganizationGetByLocationRequestDto(
                $request->latitude,
                $request->longitude,
                LocationSearchTypeEnum::from($request->type)
            ))->setRadius($request->radius)->setWidth($request->width);

            $organizations = OrganizationModule::getByLocation($dto);

            return response()->json([
                'status' => true,
                'data' => (new ROrganizationCollection($organizations))->toArray($request)
            ]);

        } catch (Throwable) {
            return response()->json([
                'status' => false,
                'error' => 'Произошла ошибка'
            ], 500);
        }
    }

    #[OA\Get(
        path: "/api/organizations/search/by-activity/{activityId}",
        operationId: "api.organizations.search.by_activity",
        description: "Ищет организации по виду деятельности, включая все подкатегории",
        summary: "Поиск организаций по виду деятельности, включая все подкатегории",
        security: [["bearerAuth" => []]],
        tags: ["Organizations"]
    )]
    #[OA\Parameter(
        name: "activityId",
        description: "ID вида деятельности для поиска",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer", example: 1)
    )]
    #[OA\Response(
        response: 200,
        description: "Результаты поиска организаций по виду деятельности",
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'boolean', example: true),
                new OA\Property(property: 'data', ref: '#/components/schemas/ROrganization')
            ]
        )
    )]
    #[OA\Response(
        response: 404,
        description: "Вид деятельности не найден",
        content: new OA\JsonContent(ref: "#/components/schemas/ErrorResponse")
    )]
    public function searchByActivity(Request $request, int $activityId): JsonResponse
    {
        try {
            $activity = ActivityModule::getRequiredById($activityId);

            $dto = (new OrganizationListRequestDto)
                ->setActivityId($activity->id)
                ->setIncludeSubActivities(true);

            $organizations = OrganizationModule::getList($dto);

            return response()->json([
                'status' => true,
                'data' => (new ROrganizationCollection($organizations))->toArray($request)
            ]);

        } catch (ActivityNotFoundException) {
            return response()->json([
                'status' => false,
                'error' => 'Вид деятельности не найден'
            ], 404);
        } catch (Throwable) {
            return response()->json([
                'status' => false,
                'error' => 'Произошла ошибка'
            ], 500);
        }
    }

    #[OA\Get(
        path: "/api/organizations/search",
        operationId: "api.organizations.search",
        description: "Ищет организации по названию",
        summary: "Поиск организаций по названию",
        security: [["bearerAuth" => []]],
        tags: ["Organizations"]
    )]
    #[OA\Parameter(
        name: "search",
        description: "Название организации для поиска",
        in: "query",
        required: true,
        schema: new OA\Schema(type: "string", example: "Кафе")
    )]
    #[OA\Response(
        response: 200,
        description: "Результаты поиска организаций по названию",
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'status', type: 'boolean', example: true),
                new OA\Property(property: 'data', ref: '#/components/schemas/ROrganization')
            ]
        )
    )]
    public function search(OrganizationSearchByNameFormRequest $request): JsonResponse
    {
        try {

            $dto = (new OrganizationListRequestDto)->setSearch($request->search);

            $organizations = OrganizationModule::getList($dto);

            return response()->json([
                'status' => true,
                'data' => (new ROrganizationCollection($organizations))->toArray($request)
            ]);

        } catch (Throwable) {
            return response()->json([
                'status' => false,
                'error' => 'Произошла ошибка'
            ], 500);
        }
    }
}
