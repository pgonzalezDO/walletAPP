<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Wallet;
use App\Models\Transfer;

class TransferTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_transfer()
    {
        $wallet = Wallet::factory()->create();
        $transfer = Transfer::factory()->make();

        $response = $this->json('POST', '/api/transfer', [
            'description' => $transfer->description,
            'amount'=> $transfer->amount,
            'wallet_id'=> $wallet->id
        ]);
        // var_dump($response);
        
        
        // $this->withoutExceptionHandling();
        $response->assertJsonStructure([
            'id','description','amount','wallet_id'
            ])->assertStatus(201);
        
        $this->assertDatabaseHas('transfers',[
            'description' => $transfer->description,
            'amount'=> $transfer->amount,
            'wallet_id'=> $wallet->id
            ]);

        $this->assertDatabaseHas('wallets', [
            'id' => $wallet->id,
            'money'=> $wallet->money + $transfer->amount
        ]);
    }
}
