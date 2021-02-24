<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Article;
use App\Models\User;
use App\Models\Word;

class LikeTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_like_article()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $article = Article::factory()->for($user)->create();
        
        $response = $this->actingAs($user)->post('/like/article', [
            'user_id' => $user->id,
            'id' => $article->id,
        ]);
        $response->assertStatus(200);
    }
    
    public function test_like_word()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $word = Word::factory()->for($user)->create();
        $response = $this->actingAs($user)->post('/like/word', [
            'user_id' => $user->id,
            'id' => $word->id,
        ]);
        $response->assertStatus(200);
    }
}
