<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Article_tag;
use App\Models\Article_like;
use App\Http\Requests\ArticleRequest;

use Log;

class ArticleController extends Controller
{
    //記事に関する
    //記事個別
    public function show($id)
    {
        
        $article = Article::find($id);
        return view('article', ['article' => $article]);
    }
    
    //記事投稿画面
    public function create()
    {
        return view('newarticle');
    }
    
    public function markdown(Request $request)
    {
        
        $test = Markdown::parse(e($request->text));
        
        return response()->json("$test");
        
    }
    
    
    //記事投稿メソッド
    public function store(ArticleRequest $request)
    {
        
        $tags = $request->selecttag;
        //タグの最大個数を5つに
        if (!empty($tags) && count($tags) > 5) {
            //最初の5つにする
            $tags = array_slice($tags, 0, 5);
        }
        
        $request->validated();
        
        $id = Auth::id();
        //ユーザーID
        $post = Article::create([
            'user_id' => $id,
            'title' => $request->title,
            'body' => $request->body,
            ]);
            
            
        //もう少しスマートにできそう
        foreach ($tags as $tag) {
            
            Article_tag::create([
                'tag_id' => $tag,
                'article_id' => $post->id
            ]);
        }
        
        
        // フラッシュしたほうがよさそう
        return redirect()->route('home');
    }
    
    
    //編集画面
    public function edit($id)
    {
        
        $article = Article::find($id);
        return view('editarticle', ['article' => $article]);
    }
    
    //編集メソッド
    public function updata(ArticleRequest $request)
    {
        $request->validated();
        
        $article = Article::findOrFail($request->id);
        $article->title = $request->title;
        $article->body = $request->body;
        $article->save();
        
        $tags = $request->selecttag;
        //タグの最大個数を5つに
        if (!empty($tags) && count($tags) > 5) {
            //最初の5つにする
            $tags = array_slice($tags, 0, 5);
        }
        
        Article_tag::where('article_id', $request->id)->delete();
        foreach ($tags as $tag) {
            
            Article_tag::create([
                'tag_id' => $tag,
                'article_id' => $request->id
            ]);
        }
        
        return redirect()->route('home');
    }
    //削除メソッド
    public function destroy(Request $request)
    {
        $id = $request->delete_id;
        Article::find($id)->delete();
        return redirect()->route('home');
    }
}
