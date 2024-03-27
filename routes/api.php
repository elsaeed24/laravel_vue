<?php

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

Route::get('fetch_student' , [\App\Http\Controllers\StudentController::class,'index']);
Route::post('store_student' , [\App\Http\Controllers\StudentController::class,'store']);
Route::get('student/{id}/show' , [\App\Http\Controllers\StudentController::class,'show']);
Route::put('student/{id}/update' , [\App\Http\Controllers\StudentController::class,'update']);
Route::delete('student/{id}/delete' , [\App\Http\Controllers\StudentController::class,'destroy']);


Route::get('fetch_course' , [\App\Http\Controllers\CourseController::class,'index']);
Route::post('store_course' , [\App\Http\Controllers\CourseController::class,'store']);
Route::get('course/{id}/show' , [\App\Http\Controllers\CourseController::class,'show']);
Route::put('course/{id}/update' , [\App\Http\Controllers\CourseController::class,'update']);
Route::delete('course/{course}/delete' , [\App\Http\Controllers\CourseController::class,'destroy']);





