<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $guarded = [];

    public function comments()
    {
        return $this->morphMany(related: Comment::class, name: "commentable");
    }
}
