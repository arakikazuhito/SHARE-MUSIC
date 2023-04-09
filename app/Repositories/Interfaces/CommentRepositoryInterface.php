<?php

namespace App\Repositories\Interfaces;


interface CommentRepositoryInterface
{

    public function commentaction(array $comment_request, int $user_id): void;

    public function getBymusicid(array $comment_request);

    public function commentByMusicid(int $id);
}
