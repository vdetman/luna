<?php

use App\Http\Api\Controllers\ActivitiesController;
use App\Http\Api\Controllers\OrganizationsController;
use Illuminate\Support\Facades\Route;


// Activities API routes
Route::prefix('activities')->group(function () {
    Route::get('/', [ActivitiesController::class, 'list']);
});

// Organizations API routes
Route::prefix('organizations')->group(function () {
    Route::get('/get/{id}', [OrganizationsController::class, 'getById']);
    Route::get('/by-building/{buildingId}', [OrganizationsController::class, 'getByBuilding']);
    Route::get('/by-activity/{activityId}', [OrganizationsController::class, 'getByActivity']);
    Route::get('/by-location', [OrganizationsController::class, 'getByLocation']);
    Route::get('/search/by-activity/{activityId}', [OrganizationsController::class, 'searchByActivity']);
    Route::get('/search', [OrganizationsController::class, 'search']);
});
