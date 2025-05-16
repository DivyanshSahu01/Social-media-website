<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['text'];
    protected $appends = ['created_date', 'created_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedBy($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function getCreatedDateAttribute()
    {
        $date = Carbon::parse($this->created_at);
        if($date->isToday())
        {
            return 'Today';
        }
        else if($date->isYesterday())
        {
            return 'Yesterday';
        }
        return $this->created_at->format('d/m/Y');
    }

    public function getCreatedTimeAttribute()
    {
        return $this->created_at->format('H:i');
    }
}
