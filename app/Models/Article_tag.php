<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Article_tag extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
        'article_id',
        'tag_id'
    ];
    
    public function article()
    {
        
        return $this->belongsTo(Article::class);
    }
    
    public function user($id)
    {
        $user = User::where('id', $id)->first();
        return $user;
    }
}
