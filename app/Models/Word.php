<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Word extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'title',
        'body'
    ];
    
    public function word_likes()
    {
        return $this->hasMany(Word_like::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function like_check($word_id)
    {
        
        $userid = Auth::id();
        $likes = Word_like::where('user_id', $userid)->where('word_id', $word_id)->first();
        
        return $likes;
    }
}
