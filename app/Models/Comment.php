<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function replies()
    {
        return $this->hasMany(related: Comment::class, foreignKey: 'parent_id');
    }

    public function parrent()
    {
        return $this->belongsTo(related: Comment::class, foreignKey: 'parent_id');
    }
}
