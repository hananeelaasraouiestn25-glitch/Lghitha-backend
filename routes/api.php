<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

Route::get('/listings', [ListingController::class, 'index']);
Route::post('/listings', [ListingController::class, 'store']);
Route::post('/listings/{id}/report', [ListingController::class, 'report']);

Route::get('/admin/listings', [ListingController::class, 'adminIndex']);
Route::patch('/admin/listings/{id}', [ListingController::class, 'update']);
Route::delete('/admin/listings/{id}', [ListingController::class, 'destroy']);