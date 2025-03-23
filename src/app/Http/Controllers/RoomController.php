<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Services\HotelService;
use App\Services\RoomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{

    public function __construct(protected RoomService $roomService, protected HotelService $hotelService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        return $this->hotelService->getHotel($id)->load('rooms');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_type' => 'required|in:single,double,suite',
            'price' => 'required|numeric|min:1'
        ]);
        
        $room = $this->roomService->createRoom($validateData, Auth::id());
        
        return response()->json([
            'message' => 'Room successfully created!',
            'room' => $room
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json($this->roomService->getRoom($id), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'room_type' => 'sometimes|in:single,double,suite',
            'price' => 'sometimes|numeric|min:1'
        ]);
        
        $room = $this->roomService->updateRoom($validateData, Auth::id(), $id);
        
        return response()->json([
            'message' => 'Room successfully updated!',
            'room' => $room
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->roomService->deleteRoom($id, Auth::id());
        return response()->json([
            'message' => 'Hotel successfully deleted!'
        ], 200);
    }
}
