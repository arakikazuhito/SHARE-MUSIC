<?php

namespace App\Repositories\Interfaces;

use App\Models\UserToken;

interface UserTokenRepositoryInterface
{
    /**
     * Userのパスワードリセット用のトークンを発行する
     * すでに存在していれば更新する
     *
     * @param int $userId
     * @return UserToken
     */
    public function updateOrCreateUserToken(int $userId): UserToken;

    public function getUserTokenfromToken(string $token): UserToken;
}
