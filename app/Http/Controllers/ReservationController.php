<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use function Laravel\Prompts\select;

class ReservationController extends Controller
{
    public function store(){

        request()->validate([
            'first_name' => 'required|min:3|max:100|string',
            'last_name' => 'required|min:3|max:100|string',
            'phone' => 'required|string',
            'room_id' => 'required|integer|exists:rooms,id',
            'comment' => 'required|min:3|max:10000|string',
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
        ]);

        $reservation = Reservation::create([
            'first_name' => request('first_name'),
            'last_name' => request('last_name'),
            'phone' => request('phone'),
            'room_id' => request('room_id'),
            'comment' => request('comment'),
            'start_at' => request('start_at'),
            'end_at' => request('end_at'),
        ]);

        return response()->json([
            'message' => 'Reservation created successfully',
            'data' => $reservation
        ], 201);
    }


    public function index(Request $request){

        $per_page = $request->query('per_page');

        if ($per_page == null) {
            $per_page = 10;
        }

        if(isset($request->start_at) && isset($request->end_at)){
            $reservations = Reservation::orderBy('start_at',"asc")
                ->Where('start_at', '>=', $request->start_at)
                ->Where('end_at', '<=', $request->end_at)
                ->paginate($per_page);
        } else {
            $reservations = Reservation::orderBy('start_at',"asc")
                ->paginate($per_page);
        }

        return response()->json([
            'message' => 'Reservation retrieved successfully',
            'data' => $reservations->map(function($reservation){
                return [
                    'first_name' => $reservation->first_name,
                    'last_name' => $reservation->last_name,
                    'phone' => $reservation->phone,
                    'room' => $reservation->room->id,
                    'comment' => $reservation->comment,
                    'start_at' => $reservation->start_at,
                    'end_at' => $reservation->end_at,
                ];
            }),
            'meta' => [
                'total' => $reservations->total(),
                'per_page' => $reservations->perPage(),
                'current_page' => $reservations->currentPage(),
                'last_page' => $reservations->lastPage(),
                'first_page_url' => $reservations->url(1)."&per_page=".$per_page,
                'last_page_url' => $reservations->url($reservations->lastPage())."&per_page=".$per_page,
                'next_page_url' => $reservations->nextPageUrl()."&per_page=".$per_page,
                'prev_page_url' => $reservations->previousPageUrl()."&per_page=".$per_page,
                'path' => $reservations->path(),
                'from' => $reservations->firstItem(),
                'to' => $reservations->lastItem()
            ]
        ], 200);
    }
}
