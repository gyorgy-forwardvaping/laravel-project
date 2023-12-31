<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'post_image',
        'body'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * mutators
     * We should use this to standardize the image inputs
     * public function setPostImageAttribute($value){
     *     $this->attributes['post_image'] = asset($value);
     * }
     */

    //accessor
    public function getPostImageAttribute($value) {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return asset('storage/' . $value);
    }

    public function getIdAttribute($value) {
        return $value;
    }

    // public function setIdAttribute($value) {
    //     return Crypt::decrypt($value);
    // }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function activeComments() {
        return $this->hasMany(Comment::class)->where('status', 2);
    }
}
