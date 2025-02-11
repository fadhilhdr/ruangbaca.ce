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

            $apiUrl = config('app.recommendation_api.url_api');
            $apiKey = config('app.recommendation_api.key');

            $response = Http::timeout(30)->withHeaders([
                'X-API-KEY' => $apiKey,
            ])->post($apiUrl, [
                'description' => $description,
            ]);

            if ($response->successful()) {
                $recommendations = $response->json();
                return response()->json($recommendations);
            } else {
                return response()->json([
                    'error' => 'Failed to fetch recommendations from API. Status Code: ' . $response->status(),
                ], $response->status());
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
}