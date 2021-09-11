<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'featured',
        'message',
        'upload',
    ];

    public function comments(): HasMany // this behaves like a fake column, e.g. for the view: $post->title, $post->id
        // AND $post->comments
    {
        return $this->hasMany(Comment::class);
        // this means this model (where you are now) which is Post
    }

    // this returns category name i.e. a relationship with Category Model
    public function category() // this creates a fake column in the post
    {
        return $this->belongsTo(Category::class); // $this = Post
        // this returns all columns from category table
        // e.g. how to use it in a controller echo $post->category->name;
    }

    public function user(){
        return $this->belongsTo(User::class);
        // $post->user->name
    }
}
