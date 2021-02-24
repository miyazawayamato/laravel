<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Article;
use App\Models\Article_like;
use App\Models\Word_like;
use App\Models\Word;
use App\Models\User;

class AjaxTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_article()
    {
        
        $user = User::factory()->create();
        
        //factory作成後
        $article = Article::factory()->create([
            'title' => 'テストタイトル',
            'user_id' => 1
        ]);
        
        $response = $this->actingAs($user)->get('/ajax/article');
        $response->assertJsonStructure();
        $response->assertJsonFragment(['title' => 'テストタイトル',]);
        $response->assertStatus(200);
    }
    
    public function test_word()
    {
        
        $user = User::factory()->create();
        
        Word::factory()->count(3)->for($user)->create([
            'title' => 'テストタイトル',
        ]);
        
        
        $response = $this->actingAs($user)->get('/ajax/word');
        $response->assertJsonStructure();
        $response->assertJsonFragment(['title' => 'テストタイトル',]);
        $response->assertStatus(200);
    }
    
    
    public function test_like_article()
    {
        //認証ユーザー作成
        $user = User::factory()->create();//3
        //投稿とそのユーザーを作成
        $article = Article::factory()->for(User::factory())->create();
        //likeのカラム作成
        $like = Article_like::factory()->create([
                    'article_id' => $article,
                    'user_id' => $user
        ]);
        
        $response = $this->actingAs($user)->get('/ajax/like/article');
        $response->assertJsonStructure();
        $response->assertStatus(200);
    }
    
    public function test_like_word()
    {
        $user = User::factory()->create();
        $word = Word::factory()->for(User::factory())->create();
        Word_like::factory()->create([
                    'word_id' => $word,
                    'user_id' => $user
        ]);
        
        $response = $this->actingAs($user)->get('/ajax/like/word');
        
        $response->assertJsonStructure();
        $response->assertStatus(200);
    }
    
}
