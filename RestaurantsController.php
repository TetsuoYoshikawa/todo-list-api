<?php

namespace App\Http\Controllers;

use App\Models\Prefecture;
use App\Models\Restaurant;
use App\Models\Genre;
use Illuminate\Http\Request;


class RestaurantController extends Controller
{
    public function get()
    {
        $restaurant = Restaurant::with('prefectures','genres','favorites')->get();
        $prefecture = Prefecture::get();
        $genre = Genre::get();
        $param = [
            "restaurant" => $restaurant,
            "prefecture" => $prefecture,
            "genre" => $genre,
        ];
        return response()->json([
            "message" => 'OK',
            "data" => $param
        ]);
    }
    public function getRestaurant(Request $request)
    {
        $items = Restaurant::where('id', $request->id)->with('prefecture', 'genre,')->get();
        if($items){
            return response()->json([
            "message" => 'OK',
            "data" => $items
            ],200);
        }else{
            return reponse()->json([
                "message" => "Not found"
            ],404);
        }
    }
}
