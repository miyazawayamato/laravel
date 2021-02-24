<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Tag;

class TagTest extends TestCase
{
    use RefreshDatabase;
    public function test_tag_add()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/tag/add', [
            'tagname' => 'テストタグ',
        ]);
        $response->assertStatus(200);
    }
    
    public function test_tag_list()
    {
        $user = User::factory()->create();
        $tag = Tag::factory()->create(['tag_name' => 'テストタグ']);
        $response = $this->actingAs($user)->get('/tag/list');
        $response->assertJsonFragment(['tag_name' => 'テストタグ',]);
        $response->assertStatus(200);
    }
}
