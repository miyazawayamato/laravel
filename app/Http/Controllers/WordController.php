<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use App\Http\Requests\WordRequest;
use Illuminate\Support\Facades\Auth;

class WordController extends Controller
{
    //
    //単語投稿メソッド
    public function store(WordRequest $request)
    {
        $request->validated();
        $id = Auth::id();
        //ユーザーID
        Word::create([
            'user_id' => $id,
            'title' => $request->title,
            'body' => $request->body,
        ]);
        
        // フラッシュしたほうがよさそう
        //リダイレクトしないとajaxが利用できない
        return redirect()->route('home');
    }
        
    //削除メソッド
    public function destroy(Request $request)
    {
        
        $id = $request->delete_id;
        Word::find($id)->delete();
        return redirect()->route('home');
    }
}
