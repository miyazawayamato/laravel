<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//ホーム
Route::get('/', [TopController::class, 'top'])->name('top');
Route::get('/show/article/{id}', [ArticleController::class, 'show'])->name('show');
Route::get('/user/{id}', [TopController::class, 'show'])->name('user');
Route::get('/search/article', [SearchController::class, 'article'])->name('a.search');
Route::get('/search/word', [SearchController::class, 'word'])->name('w.search');
Route::get('/search/{tagid}', [SearchController::class, 'tag'])->name('t.search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('homes');

Route::middleware(['auth', 'verified'])->group(function () {
    //マイページ
    Route::get('/mypage', [TopController::class, 'index'])->name('home');
    //編集画面
    Route::get('/mypage/edit', [ProfController::class, 'edit'])->name('p.edit');
    //名前変更
    Route::put('/mypage/edit/name', [ProfController::class, 'nameEdit'])->name('name.edit');
    //本文設定
    Route::post('/mypage/edit/prof', [ProfController::class, 'profEdit'])->name('prof.edit');
    //画像設定、変更
    Route::post('/mypage/edit/image', [ProfController::class, 'imageEdit'])->name('image.edit');
    Route::post('/mypage/delete/image', [ProfController::class, 'imageDelete'])->name('image.delete');
    //新記事投稿
    Route::get('/new/article', [ArticleController::class, 'create'])->name('create');
    Route::post('/new/article', [ArticleController::class, 'store'])->name('a.store');
    //マークダウンajax
    Route::get('/markdown/view', [ArticleController::class, 'markdown']);
    //投稿記事編集
    Route::get('/edit/article/{id}', [ArticleController::class, 'edit'])->name('edit');
    Route::put('/edit/article', [ArticleController::class, 'updata'])->name('updata');
    //投稿記事削除
    Route::delete('/delete/article', [ArticleController::class, 'destroy'])->name('a.delete');
    //新単語投稿
    Route::post('/new/word', [WordController::class, 'store'])->name('w.store');
    //投稿単語削除
    Route::delete('/delete/word', [WordController::class, 'destroy'])->name('w.delete');
    
    //ajaxでmypageに取得、表示する
    Route::get('/ajax/article', [AjaxController::class, 'article']);
    Route::get('/ajax/word', [AjaxController::class, 'word']);
    Route::get('/ajax/like/article', [AjaxController::class, 'likeArticle']);
    Route::get('/ajax/like/word', [AjaxController::class, 'likeWord']);
    
    //いいねの操作
    Route::post('/like/article', [LikeController::class, 'article']);
    Route::post('/like/word', [LikeController::class, 'word']);
    
    //タグ追加
    Route::post('/tag/add', [TagController::class, 'add']);
    //タグ取得
    Route::get('/tag/list', [TagController::class, 'list']);
    //マークダウンプレビュー
    
});












