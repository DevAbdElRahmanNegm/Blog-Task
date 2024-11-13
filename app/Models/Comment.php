<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['comment', 'user_id', 'post_id'];

    public function user(): HasOne
    {
        return  $this->hasOne(User::class , 'id' , 'user_id');
    }

    public function post(): HasOne
    {
        return  $this->hasOne(Post::class , 'id' , 'post_id');
    }
}
