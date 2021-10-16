<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //protected $fillable = ['name']; //find out how to let ALL fields in
    protected $guarded = [];

    public function posts(){ //acts like a column in category table, which has posts, only that belong to this category
        return $this->hasMany(Post::class);
    }
}
