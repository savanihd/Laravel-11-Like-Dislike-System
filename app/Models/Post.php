<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body'];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function likes()
    {
        return $this->hasMany(Like::class)->where('like', true);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dislikes()
    {
        return $this->hasMany(Like::class)->where('like', false);
    }
}
