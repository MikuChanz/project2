<?php

namespace App\Http\Controllers;

use App\Models\IDs;
use Illuminate\Http\JsonResponse;

class DataController extends Controller
{
    // Return 3 published IDs in random order
    public function getTopIDs(): JsonResponse
    {
        $ids = IDs::where('display', true)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return response()->json($ids);
    }

    // Return selected ID if it is published
    public function getID(IDs $ids): JsonResponse
    {
        $selectedID = IDs::where([
            'id' => $ids->id,
            'display' => true,
        ])
            ->firstOrFail();

        return response()->json($selectedID);
    }

    // Return 3 published IDs in random order, except selected ID
    public function getRelatedIDs(IDs $ids): JsonResponse
    {
        $relatedIDs = IDs::where('display', true)
            ->where('id', '<>', $ids->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return response()->json($relatedIDs);
    }
}