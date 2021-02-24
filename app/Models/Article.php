<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'user_id',
        'body'
    ];
    
    public function article_likes()
    {
        return $this->hasMany(Article_like::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }
    
    //モデルでもできる
    public function like_check($article_id)
    {
        
        $userid = Auth::id();
        $likes = Article_like::where('user_id', $userid)->where('article_id', $article_id)->first();
        
        return $likes;
    }
}
