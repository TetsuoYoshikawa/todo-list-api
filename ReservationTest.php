<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Reservation;

class ReservationapiTest extends TestCase
{
  use RefreshDatabase;

  public function test_index_rest()
  {
    $item = Rest::factory()->create();
    $response = $this->get('/api/v1/rest');
    $response->assertStatus(200);
    $response->assertJsonFragment([
      "user_id" => $item->user_id,
      "restaurant_id" => $item->restaurant_id,
      "datetime" => $item->datetime,
      "number_reservation" => $item->number_reservation
    ]);
  }
  public function test_get_rest()
  {
    $items = Reservation::where('user_id', $response->user_id)->with('reservations')->get();
    return response()->json([
      "data" => $items
    ], 200);
  }
  public function test_post_rest()
  {
    $data = Rest::create($request->all());
    return response()->json([
      'data' => $item
    ], 201);
  }
  public function test_delete_rest()
  {
    $item = Rest::where('id', $rest->id)->delete();
    if ($item) {
      return response()->json([
        'message' => 'Deleted successfully',
      ], 200);
    } else {
      return response->json([
        'message' => 'Not found'
      ], 404);
    }
  }
}
