<?php

namespace APP\Repositories\Eloquents;

use App\Models\User;
use App\Models\Music;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    private $user;

    /**
     * constructor
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function storeuser(array $user)
    {
        $user_data = $this->user->fill([
            'name'     => $user['name'],
            'email'    => $user['email'],
            'password' => Hash::make($user['password'])
        ])->save();
        return $user_data;
    }

    public function findByUserId(int $id): User
    {
        return User::find($id);
    }

    public function findByUserId_Music(int $id)
    {
        $music_data = $this->user->newQuery()
            ->select(
                'users.id',
                'music.id',
                'music.category',
                'music_name',
                'music_path',
                'music.image',
                'music.created_at'
            )
            ->leftjoin('music', 'music.user_id', '=', 'users.id')
            ->where('music.user_id', '=', $id)
            ->get();
        return $music_data;
    }

    public function findFromEmail(string $email): User
    {
        return $this->user->where('email', $email)->firstOrFail();
    }

    public function editUser(array $user, int $id): void
    {

        User::find($id)
            ->update([
                'name' => $user['name'],
                'image' => $user['update_image'],
                'self_introduction' => $user['self_introduction']
            ]);
    }

    public function serchUser(string $keyword)
    {
        return $this->user->where('name', 'LIKE', "%{$keyword}%");
    }

    public function updateUserPassword(string $password, int $id): void
    {
        $this->user->where('id', $id)->update(['password' => Hash::make($password)]);
    }
}
