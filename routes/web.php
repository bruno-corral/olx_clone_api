<?php

use App\Http\Controllers\AdvertiseController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('state/all', [StatesController::class, 'index']);
Route::get('state/{id}', [StatesController::class, 'findOne']);
Route::post('state/add', [StatesController::class, 'create']);
Route::put('state/{id}', [StatesController::class, 'update']);
Route::delete('state/{id}', [StatesController::class, 'delete']);
Route::get('state/{id}/restore', [StatesController::class, 'restore']);

Route::get('category/all', [CategoriesController::class, 'index']);
Route::get('category/{id}', [CategoriesController::class, 'findOne']);
Route::post('category/add', [CategoriesController::class, 'create']);
Route::put('category/{id}', [CategoriesController::class, 'update']);
Route::delete('category/{id}', [CategoriesController::class, 'delete']);
Route::get('category/{id}/restore', [CategoriesController::class, 'restore']);

Route::get('user/all', [UserController::class, 'index']);
Route::get('user/{id}', [UserController::class, 'findOne']);
Route::post('user/signup', [UserController::class, 'signup']);
Route::post('user/signin', [UserController::class, 'signin']);
Route::get('user/me/infos', [UserController::class, 'infos'])->middleware('auth:sanctum');
Route::put('user/{id}', [UserController::class, 'update']);
Route::delete('user/{id}', [UserController::class, 'delete']);
Route::get('user/{id}/restore', [UserController::class, 'restore']);

Route::get('advertise/all', [AdvertiseController::class, 'index']);
Route::get('advertise/{id}', [AdvertiseController::class, 'findOne']);
Route::get('advertise/{id}/info', [AdvertiseController::class, 'info']);
Route::post('advertise/add', [AdvertiseController::class, 'create']);
Route::put('advertise/update/{id}', [AdvertiseController::class, 'update']);
Route::delete('advertise/delete/{id}', [AdvertiseController::class, 'delete']);
Route::get('advertise/{id}/restore', [AdvertiseController::class, 'restore']);
