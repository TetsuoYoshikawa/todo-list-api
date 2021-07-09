<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ReservationsController extends Controller
{
    public function get(Request $request, $user_id)
    {
        if ($user_id) {
            $items = Reservation::where('user_id', $request->user_id)->with('restaurants')->get();
            return response()->json([
                'message' => 'OK',
                'data' => $items
            ], 200);
        } else {
            return response()->json([
                'status' => 'not found'
            ], 404);
        }
    }
    public function post(Request $request, $restaurant_id)
    {
        $param = [
            'user_id' => $request->user_id,
            'restaurant_id' => $restaurant_id,
            'datetime' => $request->datetime,
            'number_reservation' => $request->number_reservation,
        ];
        DB::table('Reservation')->insert($param);
    }
    public function delete($restaurant_id)
    {
        $items = DB::table('Reservations')->where('restautant_id', $restaurant_id)->delete();
        if ($items) {
            return response()->json([
                'message' => 'Reservation deleted successsfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found'
            ]);
        }
    }
}
