<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['from_id', 'text', 'to_id'];
    protected $appends = ['created_date', 'created_time'];

    public function getCreatedDateAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    public function getCreatedTimeAttribute()
    {
        return $this->created_at->format('H:i');
    }
}
