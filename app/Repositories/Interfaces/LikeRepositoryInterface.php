<?php

namespace App\Repositories\Interfaces;


interface LikeRepositoryInterface
{
    public function getLike(int $music_id, int $user_id);

    public function storeLike(int $music_id, int $user_id): void;

    public function deleteLike(int $music_id, int $user_id);

    public function countLike(int $music_id);
}
