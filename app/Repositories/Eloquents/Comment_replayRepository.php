<?php

namespace APP\Repositories\Eloquents;

use App\Models\Comment;
use App\Models\Comment_replay;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Repositories\Interfaces\Comment_replayRepositoryInterface;

class Comment_replayRepository implements Comment_replayRepositoryInterface
{
    private $comment_replay;

    /**
     * constructor
     *
     * @param Comment_replay $comment_replay
     */
    public function __construct(Comment_replay $comment_replay)
    {
        $this->comment_replay = $comment_replay;
    }

    public function comment_replayaction(array $comment_request, int $user_id): void
    {
        $now = Carbon::now();
        $this->comment_replay->fill([
            'user_id'    => $user_id,
            'music_id'   => $comment_request['music_id'],
            'comment_id' => $comment_request['comment_id'],
            'comment'    => $comment_request['comment_input'],
            'created_at' => $now
        ])->save();
    }

    public function getBymusicid(array $comment_request)
    {
        $comment_data = $this->comment_replay
            ->select(
                'users.name',
                'users.image',
                'comments_replay.id',
                'comments_replay.comment',
                'comments_replay.created_at'
            )
            ->leftjoin('users', 'users.id', 'comments_replay.user_id')
            ->where('music_id', '=', $comment_request['music_id']);

        return $comment_data;
    }
}
