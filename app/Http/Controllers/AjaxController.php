<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Article_like;
use App\Models\Word;
use App\Models\Word_like;


class AjaxController extends Controller
{
    
    public function article()
    {
        $id = Auth::id();
        //idを受け取る
        //authでとって来た方がいいかも
        $articles = Article::where('user_id', $id)->get();
        return response()->json($articles);
    }
    //
    public function word()
    {
        $id = Auth::id();
        $words = Word::where('user_id', $id)->get();
        return response()->json($words);
    }
    
    //
    public function likeArticle()
    {
        $id = Auth::id();
        
        //ユーザーIDを見つけ。そこから投稿を取得
        $articles = Article_like::where('user_id', $id)->get();
        
        foreach ($articles as $article) {
            $post[] = Article::where('id', $article->article_id)->get();
        }
        
        return response()->json($post);
        
    }
    //
    public function likeWord()
    {
        $id = Auth::id();
        $words = Word_like::where('user_id', $id)->get();
        
        foreach ($words as $word) {
            $post[] = Word::where('id', $word->word_id)->get();
        }
        return response()->json($post);
    }
}
