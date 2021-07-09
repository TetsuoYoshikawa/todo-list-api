<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;

class FavoritesController extends Controller
{
    public function get(Request $request)
    {
        $items = Favorite::where('user_id', $request->user_id)->with('restaurants')->get();
        return response()->json([
            'message' => 'OK',
            'data' => $items
        ], 200);
    }
    public function post(Request $request)
    {
        $now = Carbon::now();
        $param = [
            "user_id" => $request->user_id,
            "restaurant_id" => $request->restaurant_id,
            "creted_at" => $now,
            "updated_at" => $now
        ];
        Favorite::insert($param);
        return response()->json([
            'message' => 'Favotite created successfully',
            'data' => $param
        ], 200);
    }
    public function delete(Request $request)
    {
        $items = Favorite::where('user_id', $request->user_id)->where('restaurant_id', $request->restaurant_id)->delete();
        if($items){
            return response()->json([
            'message' => 'Favorite deleted successfully'
        ], 200);
        }else{
            return response()->json([
                'message' => "Not found"
            ],404);
        }
    }
}
