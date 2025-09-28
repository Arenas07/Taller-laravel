<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;

class BookingController extends Controller
{
    public function index()
    {
        return response()->json(Booking::with(['member','room'])->get());
    }

    public function store(StoreBookingRequest $request)
    {
        $booking = Booking::create($request->validated());
        return response()->json($booking, 201);
    }

    public function show(Booking $booking)
    {
        return response()->json($booking->load(['member','room']));
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $booking->update($request->validated());
        return response()->json($booking);
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->json(null, 204);
    }
}
