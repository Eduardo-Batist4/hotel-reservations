<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHotelRequest;
use App\Services\HotelService;
use Illuminate\Http\Request;

class HotelController extends Controller
{

    public function __construct(protected HotelService $hotelService) {}

    public function index(Request $request)
    {
        return response()->json($this->hotelService->getHotels($request->all()));
    }

    public function store(StoreHotelRequest $request)
    {
        $validateData = $request->validated();

        $hotel = $this->hotelService->createHotel($validateData);

        return response()->json([
            'message' => 'Hotel successfully created!',
            'hotel' => $hotel
        ], 201);
    }

    public function show(int $id)
    {
        return response()->json($this->hotelService->getHotel($id), 200);
    }

    public function update(StoreHotelRequest $request, int $id)
    {
        $validateData = $request->validated();

        $hotel = $this->hotelService->updateHotel($validateData, $id);

        return response()->json([
            'message' => 'Hotel successfully update!',
            'hotel' => $hotel
        ], 200);
    }

    public function destroy(int $id)
    {
        $this->hotelService->deleteHotel($id);
        return response()->json([
            'message' => 'Hotel successfully deleted!'
        ], 200);
    }
}
