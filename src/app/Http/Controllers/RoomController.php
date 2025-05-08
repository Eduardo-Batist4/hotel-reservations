<?php

namespace App\Http\Controllers;

use App\Services\HotelService;
use App\Services\RoomService;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    public function __construct(
        protected RoomService $roomService,
        protected HotelService $hotelService
    ) {}

    public function index(int $id)
    {
        return $this->roomService->getAllRooms($id);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_type' => 'required|in:single,double,suite',
            'price' => 'required|numeric|min:1'
        ]);

        $room = $this->roomService->createRoom($validateData);

        return response()->json([
            'message' => 'Room successfully created!',
            'room' => $room
        ], 201);
    }

    public function show(string $id)
    {
        return response()->json($this->roomService->getRoom($id), 200);
    }

    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'room_type' => 'sometimes|in:single,double,suite',
            'price' => 'sometimes|numeric|min:1'
        ]);

        $room = $this->roomService->updateRoom($validateData, $id);

        return response()->json([
            'message' => 'Room successfully updated!',
            'room' => $room
        ], 201);
    }

    public function destroy(string $id)
    {
        $this->roomService->deleteRoom($id);
        return response()->json([
            'message' => 'Hotel successfully deleted!'
        ], 200);
    }
}
