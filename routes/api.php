<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('users', UserController::class);

Route::post('users/update/{id}', [UserController::class, 'updateData']);

// additional route for login
Route::post('login', [UserController::class, 'login']);
Route::get('/current-user', [UserController::class, 'getCurrentUser']);
Route::post('logout', [UserController::class, 'logout']);
Route::post('register', [UserController::class, 'register']);
Route::apiResource('courses', CourseController::class);
Route::post('courses/update-course/{id}', [CourseController::class, 'updateData']);
// Route::middleware(['auth', 'admin'])->post('/update-course/{id}', [CourseController::class, 'updateData'])->name('update-course');


