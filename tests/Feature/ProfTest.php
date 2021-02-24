<?php

namespace Tests\Feature;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProfTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_edit()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/mypage/edit');
        $response->assertStatus(200)->assertSee($user->name);
    }
    
    public function test_name_edit()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/mypage/edit/name', [
            'name' => 'テストネーム',
        ]);
        $response->assertStatus(302);
    }
    
    public function test_prof_edit()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/mypage/edit/prof', [
            'prof' => 'テストプロフィール紹介文',
        ]);
        $response->assertStatus(302);
    }
    
}
