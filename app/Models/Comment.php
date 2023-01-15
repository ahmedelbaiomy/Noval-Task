<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable=['post_id','user_id','comment'];
    protected $dates = ['deleted_at'];

    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date("M-d-Y"),
        );
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function scopeCountcomments($query,$id){
        return $query->where('post_id',$id)->count();
    }
}
