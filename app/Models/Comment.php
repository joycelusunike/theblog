<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'post_id',
        'comment',
    ];

    public function user(){ // fake column into Comment table
        return $this->belongsTo(User::class);
        // all the columns from user, e.g. $comment->user->name
    }
}
