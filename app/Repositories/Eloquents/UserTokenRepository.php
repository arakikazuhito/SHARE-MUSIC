<?php

namespace App\Repositories\Eloquents;

use App\Models\UserToken;
use App\Repositories\Interfaces\UserTokenRepositoryInterface;
use Carbon\Carbon;

class UserTokenRepository implements UserTokenRepositoryInterface
{
    private $userToken;

    /**
     * constructor
     *
     * @param UserToken $userToken
     */
    public function __construct(UserToken $userToken)
    {
        $this->userToken = $userToken;
    }


    public function updateOrCreateUserToken(int $userId): UserToken
    {
        $now = Carbon::now();
        $hashedToken = hash('sha256', $userId);
        return $this->userToken->updateOrCreate(
            [
                'user_id' => $userId,
            ],
            [
                'token' => uniqid(rand(), $hashedToken),
                'expire_at' => $now->addHours(48),
            ]
        );
    }
    public function getUserTokenfromToken(string $token): UserToken
    {
        return $this->userToken->where('token', $token)->firstOrFail();
    }
}
