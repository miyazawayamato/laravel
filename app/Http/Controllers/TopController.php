<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Word;
use App\Models\User;
use App\Models\Article_like;
use App\Models\Word_like;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    
    public function top() 
    {
        
        $articles = Article::latest()->take(20)->with('user')->get();;
        $words = Word::latest()->take(20)->with('user')->get();
    
        
        
        return view('top', [
            'articles' => $articles,
            'words' => $words]);
    }
    
    
    
    //マイページ表示
    public function index()
    {
        $id = Auth::id();
        $user = User::find($id);
        
        return view('mypage', ['user' => $user]);
    }
    
    //ユーザー個別
    public function show($account)
    {
        //ここにidかユーザIDを渡す
        $user = User::where('account', $account)->first();
        
        if (Auth::check() && Auth::id() === $user->id) {
            
            return redirect()->route('home');
        }
        
        return view('user', ['user' => $user]);
    }
}
