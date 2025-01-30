<?php
namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookRecommendationController extends Controller
{
    public function getRecommendations(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'description' => 'required|string',
            ]);

            // Buat client Guzzle
            $client = new Client();

            // Kirim request ke Flask API
            $response = $client->post('http://127.0.0.1:5000/recommend', [
                'json' => ['description' => $request->input('description')],
            ]);

            // Decode response dari Flask API
            $body = json_decode($response->getBody(), true);

            return response()->json([
                'status'          => 'success',
                'recommendations' => $body,
            ]);
        } catch (\Exception $e) {
            // Log error
            Log::error('Error fetching recommendations: ' . $e->getMessage());

            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to fetch recommendations',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}