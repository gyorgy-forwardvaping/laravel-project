<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'avatar',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function userHasRole($role_name) {
        foreach ($this->roles as $role) {
            if (Str::lower($role_name) == Str::lower($role->name)) {
                return true;
            }
        }
        return false;
    }

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = bcrypt($value);
    }

    // public function getIdAttribute($value) {
    //     return Crypt::encrypt($value);
    // }

    // public function setIdAttribute($value) {
    //     return Crypt::decrypt($value);
    // }

    public function getAvatarAttribute($value) {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return asset('storage/' . $value);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
