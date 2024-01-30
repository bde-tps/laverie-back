<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Room::all()->map(function ($room) {
                return [
                    'id' => $room->id,
                    'name' => $room->name,
                ];
            }),
        ]);
    }

    public function show(Room $room)
    {
        return response()->json([
            'data' => [
                'id' => $room->id,
                'name' => $room->name,
            ],
        ]);
    }
}
