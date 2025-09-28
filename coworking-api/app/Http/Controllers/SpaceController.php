<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Space;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    public function index()
    {
        return response()->json(Space::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);

        $space = Space::create($validated);

        return response()->json($space, 201);
    }

    public function show(Space $space)
    {
        return response()->json($space, 200);
    }

    public function update(Request $request, Space $space)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'nullable|string',
        ]);

        $space->update($validated);

        return response()->json($space, 200);
    }

    public function destroy(Space $space)
    {
        $space->delete();
        return response()->json(null, 204);
    }
}
