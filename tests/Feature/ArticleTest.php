<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use App\Models\Tag;
use App\Http\Controllers\ArticleController;
use App\Models\Article_like;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Log;

class ArticleTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_show()
    {
        
        User::factory()
            ->has(Article::factory()->state(['title' => 'テストタイトル']))
            ->create();
        
        $response = $this->get('/show/article/1');
        $response->assertStatus(200)->assertSee('テストタイトル');
    }
    
    public function test_show_auth()
    {
        //認証済みユーザーはいいねマークが出るか
        $user = User::factory()->create();
        $article = Article::factory()->for($user)->create();
        $response = $this->actingAs($user)->get('/show/article/'.$article->id);
        $response->assertStatus(200)
            ->assertSee('<i class="far fa-star article" data-aid="'.$article->id.'"></i>', false);
    }
    
    
    public function test_create()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/new/article');
        //どのviewが表示されるか、文字が表示されているか
        $response->assertStatus(200)
                ->assertViewIs('newarticle')
                ->assertSee('プレビュー');
    }
    
    
    public function test_markdown()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/markdown/view');
        $response->assertStatus(200);
    }
    
    
    public function test_store()
    {
        $tag = Tag::factory()->create();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/new/article', [
            'title' => 'これはテストです',
            'body' => 'テストの本文です',
            'user_id' => $user->id,
            'selecttag' => [0 => $tag->id]
        ]);
        //リダイレクトは302
        $response->assertStatus(302);
    }
    
    public function test_edit()
    {
        $user = User::factory()->create();
        $article = Article::factory()->for($user)->create();
        
        $response = $this->actingAs($user)->get('/edit/article/'.$article->id);
        
        $response->assertStatus(200);
    }
    
    public function test_updata()
    {
        $tag = Tag::factory()->create();
        $user = User::factory()->create();
        $article = Article::factory()->for($user)->create();
        $response = $this->actingAs($user)->post('/edit/article', [
            'id' => $article->id,
            'title' => 'これはテストです',
            'body' => 'テストの本文です',
            'user_id' => $user->id,
            'selecttag' => [0 => $tag->id]
        ]);
        $response->assertStatus(302);
    }
    
    public function test_destroy()
    {
        
        $user = User::factory()->create();
        $article = Article::factory()->for($user)->create();
        $response = $this->actingAs($user)->delete('/delete/article/', [
            'delete_id' =>$article->id
        ]);
        $response->assertStatus(302);
    }
}
