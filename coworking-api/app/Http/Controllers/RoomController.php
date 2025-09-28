<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Amenity;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoomRequest;

class RoomController extends Controller
{
    /**
     * Listar todas las salas
     */
    public function index()
    {
        // Cargar también las amenities relacionadas
        return Room::with('amenities')->get();
    }

    /**
     * Crear una sala nueva
     */
    public function store(StoreRoomRequest $request)
    {
        $validated = $request->validate([
            'space_id' => 'required|exists:spaces,id',
            'name'     => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'type'     => 'required|string|in:meeting,workshop,phonebooth,auditorium',
            'is_active'=> 'boolean',
        ]);

        $room = Room::create($validated);

        return response()->json($room, 201);
    }

    /**
     * Mostrar una sala específica
     */
    public function show(Room $room)
    {
        return $room->load('amenities');
    }

    /**
     * Actualizar sala
     */
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'space_id' => 'sometimes|exists:spaces,id',
            'name'     => 'sometimes|string|max:255',
            'capacity' => 'sometimes|integer|min:1',
            'type'     => 'sometimes|string|in:meeting,workshop,phonebooth,auditorium',
            'is_active'=> 'boolean',
        ]);

        $room->update($validated);

        return response()->json($room);
    }

    /**
     * Eliminar sala
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json(null, 204);
    }

    /**
     * Asociar una amenidad a la sala
     */
    public function attachAmenity(Room $room, Amenity $amenity)
    {
        $room->amenities()->syncWithoutDetaching([$amenity->id]);
        return response()->json(['message' => 'Amenity attached successfully']);
    }

    /**
     * Quitar una amenidad de la sala
     */
    public function detachAmenity(Room $room, Amenity $amenity)
    {
        $room->amenities()->detach($amenity->id);
        return response()->json(['message' => 'Amenity detached successfully']);
    }
}
