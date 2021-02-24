<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class TopTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_tpopage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    
    public function test_mypage()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/mypage');
        $response->assertStatus(200)->assertSeeText($user->name);
    }
    
    public function test_userpage()
    {
        $user = User::factory()->create();
        $response = $this->get('/user/'.$user->account);
        $response->assertStatus(200);
    }
}
