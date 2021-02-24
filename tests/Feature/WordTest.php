<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Word;

class WordTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_store()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/new/word', [
            'title' => 'これはテストです',
            'body' => 'テストの本文です',
            'user_id' => $user->id,
        ]);
        $response->assertStatus(302);
    }
    
    public function test_destroy()
    {
        $user = User::factory()->create();
        $word = Word::factory()->for($user)->create();
        $response = $this->actingAs($user)->delete('/delete/word/', [
            'delete_id' => $word->id
        ]);
        $response->assertStatus(302);
    }
}
