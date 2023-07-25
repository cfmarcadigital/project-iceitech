<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ModuleController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VideoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::resource('blogs', BlogController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('modules', ModuleController::class);
    Route::resource('videos', VideoController::class);
});

Route::get('blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');

Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('courses/{course}', [CourseController::class, 'show'])->name('courses.show');

Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');

Route::get('modules', [ModuleController::class, 'index'])->name('modules.index');
Route::get('modules/{module}', [ModuleController::class, 'show'])->name('modules.show');

Route::get('roles', [RoleController::class, 'index'])->name('roles.index');

Route::get('videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('videos/{video}', [VideoController::class, 'show'])->name('videos.show');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);