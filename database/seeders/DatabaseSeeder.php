<?php

namespace Database\Seeders;
use App\Models\Article;
use App\Models\User;
use App\Models\Word;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(4)->create();
        // $this->call(ArticleSeeder::class);
        User::factory()
            ->has(Word::factory()->count(3))
            ->has(Article::factory()->count(3)->has(Tag::factory()->count(1)))
            ->create();
    }
}
