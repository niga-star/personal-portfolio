<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SkillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| RESTful API Specifications (SRS Chapter 5)
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    // 5.1 Public Endpoints
    Route::get('/profile', [ProfileController::class, 'index']);
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{slug}', [ProjectController::class, 'show']);
    Route::get('/skills', [SkillController::class, 'index']);
    Route::get('/download-cv', [ProfileController::class, 'downloadCv']);

    // Rate-limited contact submission (SRS 5.1: 5 req/min)
    Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1');

    // Authentication with brute-force rate-limiting (5 attempts/min)
    Route::post('/auth/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

    // 5.2 Protected Admin Endpoints (Auth: Sanctum)
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/auth/user', [AuthController::class, 'user']);
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::post('/admin/change-password', [AuthController::class, 'changePassword']);

        // Admin Projects CRUD
        Route::post('/admin/projects', [ProjectController::class, 'store']);
        Route::put('/admin/projects/{id}', [ProjectController::class, 'update']);
        Route::delete('/admin/projects/{id}', [ProjectController::class, 'destroy']);

        // Admin Skills CRUD
        Route::post('/admin/skills', [SkillController::class, 'store']);
        Route::put('/admin/skills/{id}', [SkillController::class, 'update']);
        Route::delete('/admin/skills/{id}', [SkillController::class, 'destroy']);

        // Admin Messages
        Route::get('/admin/messages', [ContactController::class, 'index']);
        Route::put('/admin/messages/{id}/read', [ContactController::class, 'markAsRead']);
        Route::delete('/admin/messages/{id}', [ContactController::class, 'destroy']);

        // Admin Profile & Journey Updates
        Route::put('/admin/profile', [ProfileController::class, 'update']);
        Route::post('/admin/experiences', [ProfileController::class, 'storeExperience']);
        Route::put('/admin/experiences/{id}', [ProfileController::class, 'updateExperience']);
        Route::delete('/admin/experiences/{id}', [ProfileController::class, 'destroyExperience']);
    });
});
