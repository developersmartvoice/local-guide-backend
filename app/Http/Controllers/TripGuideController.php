<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TripGuide;

class TripGuideController extends Controller
{
    public function createTripGuide(Request $request)
    {
        // Assuming $request contains the necessary data for creating a trip guide

        $tripGuide = TripGuide::create($request->all());

        return response()->json($tripGuide, 201);
    }

    public function getTripGuides()
    {
        $tripGuides = TripGuide::all();

        return response()->json($tripGuides, 200);
    }
}
