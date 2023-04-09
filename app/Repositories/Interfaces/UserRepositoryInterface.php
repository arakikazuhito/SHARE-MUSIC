<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function storeuser(array $user);

    public function findByUserId(int $id): User;

    public function findByUserId_Music(int $id);

    public function findFromEmail(string $email): User;

    public function serchUser(string $keyword);

    public function editUser(array $user, int $id): void;

    public function updateUserPassword(string $password, int $id): void;
}
