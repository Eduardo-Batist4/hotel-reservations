<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Services\HotelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{

    public function __construct(protected HotelService $hotelService) {}

    public function index(Request $request)
    {
        return response()->json($this->hotelService->getHotels($request->all()));
    }

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


    public function show(string $id)
    {
        return response()->json($this->hotelService->getHotel($id), 200);
    }


    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name' => 'sometimes|string|min:4|max:255',
            'location' => 'sometimes|string|min:8|max:255',
            'amenities' => 'sometimes|string|min:8|max:300'
        ]);

        $hotel = $this->hotelService->updateHotel($validateData, $id, Auth::id());

        return response()->json($hotel, 200);
    }

    public function destroy(string $id)
    {
        $this->hotelService->deleteHotel($id, Auth::id());
        return response()->json('Successfully deleted!', 204);
    }
}
