<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article_like extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'article_id',
        'user_id'
    ];
    
    public function article()
    {
        return $this->belongsToMany(Article::class);
    }
}
