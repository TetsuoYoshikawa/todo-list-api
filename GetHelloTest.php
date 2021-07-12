<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Restaurant;

class GetHelloTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_rest()
    {
        /*RestControoler_indexの中身 
        $items = Rest::all();
        return response()->json([
            'data' => $items
        ],200);* /

        /*コードでまずはテーブルにダミーの値を挿入し、$itemという変数に代入しています。 */
        $item = Rest::factory()->create();
        /*getメソッドで/api/v1/restのAPIを叩き$responseという変数に代入しています。 */
        $response = $this->get('/api/v1/rest');
        /*レスポンスが正常に行われているかを確認しています。 */
        $response->assertStatus(200);
        /*モデルで作成した値がレスポンスの中に含まれているかを確認しています。 */
        $response->assertJsonFragment([
            'message' => $item->message,
            'url' => $item->url
        ]);
    }
    public function test_store_rest()
    {
        /* RestController_storeの中身
        $item = Rest::create($request->all());
        return response()->json([
            'data' => $item
        ],201);*/

        /*$dataの連想配列を用意*/
        $data = [
            'message' => 'rest',
            'url' => 'rest@example.com',
        ];
        /*postメソッドで/api/v1/restAPIをたたき、$dataをbodyに含めている */
        $response =  $this->post('/api/v1/rest',$data);
        /* APIのレスポンスが正常にできているか確認*/
        $response->assertStatus(201);
        /*レスポンスに送信した値がしっかりと含まれているのかの確認 */
        $response->assertJsonFragment($data);
        /*以下のコードでDBにしっかり値が入っているか検証している */
        $this->assertDatabaseHas('rests',$data);
    }
    public function test_show_rest()
    {
        /*RestController_showの中身 
        $item = Rest::find($rest);
        if($item){
            return response()->json([
                'data' => $item
            ],200);
        }else{
            return seponse()->json([
                'message' => 'Not found'
            ],404);
        }*/
        /*下記のコードでテーブルにダミーの値を挿入し$itemという変数を代入 */
        $item = Rest::factory()->create();
        /*getメソッドで/api/v1/restのAPIをたたき$responseという変数に代入 */
        $response = $this->get('/api/v1/rest/' .$item->id);
        /*レスポンスが正常に行われているか確認 */
        $response->assertStatus(200);
        /* モデルで作成した値がレスポンスの中に含まれているか確認 */
        $response->assertJsonFragment([
            'message' => $item->messaage,
            'url' => $item->url
        ]);
    }
    public function test_updata_rest()
    {
        /* RestController_updataの中身
        $updata = [
            'message => $request->message,
            'url' => $request->url
        ];
        $item = Rest::where('id',$rest->id)->updata($updata);
        if($item){
            return response()->json([
                'message' => 'Updataed successfully',
            ],200);
        }else{
            return response()->json([
                'message' => 'Not found'
            ],404);
        } */
        /*以下のコードでまずテーブルにダミーの値を挿入し$itemという変数に代入 */
        $item = Rest::factory()->creste();
        /*以下のコードで$dataという連想配列を用意 */
        $data = [
            'message' => 'rest_updata',
            'url'=> 'rest_updata@example.com',
        ];
        /*updataメソッドで/api/v1/restのAPIをたたき$responseという変数に代入*/
        $response = $this->put('/api/v1/rest/' .$item->id,$data);
        /*レスポンスが正常に行われているか確認 */
        $response->assertStatus(200);
        /*以下のコードでDBにしっかり値が入っているか検証している */
        $response->assertDatabaseHas('rests',$data);
    }
    public function test_destory_rest()
    {
        /* RestController_updataの中身
        $item = Rest::where('id',$rest->id)->delete();
        if($item){
            return response()->json([
                'message' => 'Deleted successfully',
            ],200);
        }else{
            return response()->json([
                'message' => 'Not found',
            ],404);
        } */
        /* コードでまずはテーブルにダミーの値を挿入し、$itemという変数に代入*/
        $item = Rest::factory()->create();
        /*deleteメソッドで/api/v1/restのAPIを叩き$responseという変数に代入*/
        $response = $this->delete('/api/v1/rest' .$item->id);
        /*レスポンスが正常に行われているかを確認しています。*/
        $response->assertStatus(200);
        /*コードでデータベースから値が削除されたことを確認しています。 */
        $this->assertDeleted($item);
    }
}
