<?php
namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookRecommendationController extends Controller
{

    public function getRecommendations(Request $request)
    {
        try {
            $request->validate([
                'description' => 'required|string',
            ]);

            $description = $request->input('description');

            $response = Http::timeout(30)->post('http://localhost:5000/recommend', [
                'description' => $description,
            ]);

            if ($response->successful()) {
                $recommendations = $response->json();
                return response()->json($recommendations);
            }

            return response()->json([
                'error' => 'Failed to fetch recommendations from API',
            ], 500);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
}