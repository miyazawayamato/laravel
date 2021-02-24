<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article_like;
use App\Models\Word_like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    //
    public function article(Request $request)
    {
        $id = $request->id;
        
        $userid = Auth::id();
        
        $like = Article_like::where('user_id', $userid )->where('article_id', $id)->first();
        
        if (empty($like)) {
            //作成する
            Article_like::create([
                'user_id' => $userid,
                'article_id' => $id
            ]);
            //responseは意味なし
            return response(1);
        } else {
            //削除する
            Article_like::where('id', $like->id)->delete();
            return response(2);
        }
        
    }
    
    
    //
    public function word(Request $request)
    {
        $id = $request->id;
        $userid = Auth::id();
        
        //userid変更
        $like = Word_like::where('user_id', $userid )->where('word_id', $id)->first();
        
        
        if (empty($like)) {
            //作成する
            Word_like::create([
                'user_id' => $userid ,
                'word_id' => $id
            ]);
            //responseは意味なし
            return response()->json(1);
        } else {
            //削除する
            Word_like::where('id', $like->id)->delete();
            return response()->json(2);
        }
        
    }
}
