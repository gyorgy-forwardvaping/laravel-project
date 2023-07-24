<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model {
    use HasFactory;

    protected $fillable = [
        'status',
        'user_id',
        'comment',
        'post_id'
    ];

    public function replies() {
        return $this->hasMany(CommentReply::class);
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
