<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Services\HotelService;
use App\Services\RoomService;

class RoomController extends Controller
{

    public function __construct(
        protected RoomService $roomService,
        protected HotelService $hotelService
    ) {}

    public function index(int $id)
    {
        return response()->json($this->roomService->getAllRooms($id), 200);
    }

    public function store(StoreRoomRequest $request)
    {
        $validateData = $request->validated();

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

    public function update(UpdateRoomRequest $request, string $id)
    {
        $validateData = $request->validated();

        $room = $this->roomService->updateRoom($validateData, $id);

        return response()->json([
            'message' => 'Room successfully updated!',
            'room' => $room
        ], 200);
    }

    public function destroy(string $id)
    {
        $this->roomService->deleteRoom($id);
        return response()->json([
            'message' => 'Room successfully deleted!'
        ], 200);
    }
}
