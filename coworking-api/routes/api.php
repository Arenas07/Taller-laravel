<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InvoiceController;

Route::apiResources([
  'spaces'    => SpaceController::class,
  'rooms'     => RoomController::class,
  'bookings'  => BookingController::class,
  'payments'  => PaymentController::class,
  'invoices'  => InvoiceController::class,
]);

Route::get('/members/{id}/bookings', [MemberController::class, 'index']);
Route::post('rooms/{room}/amenities/{amenity}', [RoomController::class,'attachAmenity']);
