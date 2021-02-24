<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    //タグの追加
    public function add(Request $request)
    {
        $request->validate([
            'tagname' => 'required|max:10'
        ]);
        
        $tag = $request->tagname;
        
        //一致しているか
        $name = Tag::where('tag_name', $tag)->first();
        
        //していなければ追加
        if (empty($name)) {
            Tag::create([
                'tag_name' => $tag
            ]);
            return response()->json($tag);
        } else {
            return response()->json(2);
        }
        
    }
    
    //タグの取得
    public function list()
    {
        $tags = Tag::get();
        return response()->json($tags);
        
    }
}
