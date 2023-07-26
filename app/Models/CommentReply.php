<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model {
    use HasFactory;

    protected $fillable = [
        'status',
        'user_id',
        'comment',
        'comment_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
