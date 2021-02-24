<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Word;
use App\Models\Tag;
use App\Models\Article_tag;

class SearchController extends Controller
{
    //
    public function article(Request $request)
    {
        $keyword = $request->keyword;
        
        $articles = array();
        $count = 0;
        if (!empty($keyword)) {
            $articles = Article::where('title','like',"%$keyword%")
            ->orWhere('body','like',"%$keyword%")->simplePaginate(30);
            
            $count = $articles->count();
        }
        
        
        return view('searchArticle', ['articles' => $articles, 'keyword' => $keyword, 'count' => $count]);
    }
    //
    public function word(Request $request)
    {
        $keyword = $request->keyword;
        
        $words = array();
        $count = 0;
        if (!empty($keyword)) {
            $words = Word::where('title','like',"%$keyword%")
            ->orWhere('body','like',"%$keyword%")->get();
            
            $count = $words->count();
        }
        
        return view('searchWord', ['words' => $words, 'keyword' => $keyword, 'count' => $count]);
    }
    
    public function tag($tagid)
    {
        $tags = Tag::all();
        $tag = Tag::find($tagid);
        $articles= Article_tag::where('tag_id', $tagid)->join('articles', 'articles.id', '=', 'article_tags.article_id')->simplePaginate(30);
        
        $count = $articles->count();
        
        
        
        return view('searchTag', ['articles' => $articles, 'count' => $count, 'tags' =>$tags, 'tag' => $tag]);
    }
}
