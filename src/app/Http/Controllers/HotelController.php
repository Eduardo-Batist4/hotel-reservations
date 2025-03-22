<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Services\HotelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{

    public function __construct(protected HotelService $hotelService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->hotelService->getHotels();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|min:4|max:255',
            'location' => 'required|string|min:8|max:255',
            'amenities' => 'required|string|min:8|max:300'
        ]);

        $hotel = $this->hotelService->createHotel($validateData, Auth::id());

        return response()->json($hotel, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        return response()->json($this->hotelService->getHotel($id), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name' => 'required|string|min:4|max:255',
            'location' => 'required|string|min:8|max:255',
            'amenities' => 'required|string|min:8|max:300'
        ]);

        $hotel = $this->hotelService->updateHotel($validateData, $id, Auth::id());

        return response()->json([
            'message' => 'Hotel successfully updated!',
            'hotel' => $hotel
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->hotelService->deleteHotel($id);
        return response()->json([
            'message' => 'Hotel successfully deleted!'
        ], 200);
    }
}
