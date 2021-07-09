<?php

namespace App\Http\Controllers;

use App\Models\Prefecture;
use App\Models\Restaurant;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RestaurantsController extends Controller
{
    public function get()
    {
        $restaurant = Restaurant::with('prefectures', 'genres')->get();
        $prefecture = Prefecture::get();
        $genre = Genre::get();
        $items = [
            "restaurant" => $restaurant,
            "prefecture" => $prefecture,
            "genre" => $genre,
        ];
        return response()->json([
            "message" => 'OK',
            "data" => $items
        ], 200);
    }
    public function getGenre()
    {
        $genres = Genre::get();
        return response()->json([
            "message" => "OK",
            "data" => $genres
        ], 200);
    }
    public function getPrefecture()
    {
        $prefectures = Prefecture::get();
        return response()->json([
            "message" => "OK",
            "data" => $prefectures
        ], 200);
    }
    public function getRestaurant(Request $request)
    {
        $items = Restaurant::where('id', $request->id)->with('prefecture', 'genre,')->get();
        if ($items) {
            return response()->json([
                "message" => 'OK',
                "data" => $items
            ], 200);
        } else {
            return response()->json([
                "message" => "Not found"
            ], 404);
        }
    }
}
