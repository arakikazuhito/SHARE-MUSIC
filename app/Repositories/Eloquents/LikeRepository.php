<?php

namespace App\Repositories\Eloquents;

use App\Models\Like;
use App\Models\Music;
use App\Repositories\Interfaces\LikeRepositoryInterface;
use Carbon\Carbon;

class LikeRepository implements LikeRepositoryInterface
{
    private $like;

    /**
     * constructor
     *
     * @param Like $like
     */
    public function __construct(Like $like)
    {
        $this->like = $like;
    }

    public function getLike(int $music_id,  int $user_id)
    {
        return Like::where('user_id', $user_id)->where('music_id', $music_id)->first();
    }

    public function storeLike(int $music_id, int $user_id): void
    {
        $this->like->fill([
            'music_id' => $music_id,
            'user_id' => $user_id,
        ])->save();
    }

    public function deleteLike(int $music_id, int $user_id): void
    {
        Like::where('music_id', $music_id)->where('user_id', $user_id)->delete();
    }

    public function countLike(int $music_id)
    {
        return Music::withCount('likes')->findOrFail($music_id)->likes_count;
    }
}
