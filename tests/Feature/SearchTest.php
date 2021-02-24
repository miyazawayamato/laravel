<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Article;
use App\Models\User;
use App\Models\Word;
use App\Models\Tag;
use App\Models\Article_tag;

class SearchTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_article_search()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        
        //factory作成後
        Article::factory()->create([
            'title' => 'テストタイトル',
            'user_id' => $user->id
        ]);
        $response = $this->json('GET', '/search/article', ['keyword' => 'タイトル']);
        
        $response->assertStatus(200)->assertSee('タイトル');
    }
    
    public function test_word_search()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        
        //factory作成後
        Word::factory()->create([
            'title' => 'テストタイトル',
            'user_id' => $user->id
        ]);
        $response = $this->json('GET', '/search/word', ['keyword' => 'タイトル']);
        
        $response->assertStatus(200)->assertSee('タイトル');
    }
    
    public function test_tag_search()
    {
        $this->withoutExceptionHandling();
        $article = Article::factory()->for(User::factory())->create();
        $tag = Tag::factory()->create();
        Article_tag::factory()->create(['article_id' => $article->id, 'tag_id' => $tag->id]);
        $response = $this->get('/search/'.$tag->id);
        $response->assertStatus(200);
    }
}
