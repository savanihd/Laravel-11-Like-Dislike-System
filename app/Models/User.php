<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function hasLiked($postId)
    {
        return $this->likes()->where('post_id', $postId)->where('like', true)->exists();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function hasDisliked($postId)
    {
        return $this->likes()->where('post_id', $postId)->where('like', false)->exists();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function toggleLikeDislike($postId, $like)
    {
        // Check if the like/dislike already exists
        $existingLike = $this->likes()->where('post_id', $postId)->first();

        if ($existingLike) {
            if ($existingLike->like == $like) {
                $existingLike->delete();

                return [
                    'hasLiked' => false,
                    'hasDisliked' => false
                ];
            } else {
                $existingLike->update(['like' => $like]);
            }
        } else {
            $this->likes()->create([
                'post_id' => $postId,
                'like' => $like,
            ]);
        }

        return [
            'hasLiked' => $this->hasLiked($postId),
            'hasDisliked' => $this->hasDisliked($postId)
        ];
    }
}
