<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word_like extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'word_id',
        'user_id'
    ];
    
    public function word()
    {
        return $this->belongsToMany(Word::class);
    }
}
