<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;


class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $inst = new Article([
            'user_id' => '1',
            'title' => 'テストタイトル１',
            'body' => 'テスト１テストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテスト',
        ]);
        $inst->save();
        $inst = new Article([
            'user_id' => '1',
            'title' => 'テストタイトル２',
            'body' => 'テスト２テストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテスト',
        ]);
        $inst->save();
        $inst = new Article([
            'user_id' => '1',
            'title' => 'テストタイトル３',
            'body' => 'テスト３テストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテスト',
        ]);
        $inst->save();
        $inst = new Article([
            'user_id' => '2',
            'title' => 'テストタイトル４',
            'body' => 'テスト４テストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテスト',
        ]);
        $inst->save();
        $inst = new Article([
            'user_id' => '3',
            'title' => 'テストタイトル５',
            'body' => 'テスト５テストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテスト',
        ]);
        $inst->save();
    }
}
