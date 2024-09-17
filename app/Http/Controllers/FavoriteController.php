<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $cropId = $request->input('crop_id');

        // Validate input
        $request->validate([
            'crop_id' => 'required|integer|exists:crops,id',
        ]);

        // Check if the crop is already favorited
        if ($user->favorites()->where('crop_id', $cropId)->exists()) {
            return response()->json(['message' => 'Already in favorites'], 400);
        }

        // Add crop to favorites
        $user->favorites()->create(['crop_id' => $cropId]);

        return response()->json(['message' => 'Crop added to favorites']);
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        $cropId = $request->input('crop_id');

        // Validate input
        $request->validate([
            'crop_id' => 'required|integer|exists:crops,id',
        ]);

        // Remove crop from favorites
        $user->favorites()->where('crop_id', $cropId)->delete();

        return response()->json(['message' => 'Crop removed from favorites']);
    }

    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Fetch the user's favorite crops along with the crop details
        $favorites = $user->favorites()->with('crop')->get();

        // Return the favorites as a JSON response
        return response()->json($favorites);
    }
}
