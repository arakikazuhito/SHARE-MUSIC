<?php

namespace APP\Repositories\Eloquents;

use App\Models\Comment;
use Carbon\Carbon;


use App\Repositories\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    private $comment;

    /**
     * constructor
     *
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function commentaction(array $comment_request, int $user_id): void
    {
        $now = Carbon::now();
        $this->comment->fill([
            'user_id'    => $user_id,
            'music_id'   => $comment_request['music_id'],
            'comment'    => $comment_request['comment_input'],
            'created_at' => $now
        ])->save();
    }

    public function getBymusicid(array $comment_request)
    {
        $comment_data = $this->comment
            ->select(
                'comments.id',
                'comments.user_id',
                'comments.music_id',
                'comments.comment',
                'comments.created_at',
                'users.name',
                'users.image'
            )
            ->leftjoin('users', 'users.id', '=', 'comments.user_id')
            ->where('music_id', '=', $comment_request['music_id']);

        return $comment_data;
    }

    public function commentByMusicid(int $id)
    {
        return $this->comment->with('user:id,name,image', 'comments_replay.user:id,name,image')
            ->where('comments.music_id', '=', $id)
            ->orderBy('comments.created_at', 'DESC');
    }
}
