<?php

namespace App\Repositories\Interfaces;


interface Comment_replayRepositoryInterface
{
    public function comment_replayaction(array $comment_request, int $user_id): void;

    public function getBymusicid(array $comment_request);
}
