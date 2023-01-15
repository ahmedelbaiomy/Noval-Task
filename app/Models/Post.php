<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['title','content','image','author'];
    protected $dates = ['deleted_at'];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('assets/images/posts/'.$value),
        );
    }
    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date("M-d-Y"),
        );
    }
    public function user()
    {
        return $this->belongsTo(User::class,'author','id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
