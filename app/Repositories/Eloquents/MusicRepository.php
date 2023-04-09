<?php

namespace APP\Repositories\Eloquents;

use App\Models\Music;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\MusicRepositoryInterface;

class MusicRepository implements MusicRepositoryInterface
{

    private $music;

    /**
     * constructor
     *
     * @param Music $music
     */
    public function __construct(Music $music)
    {
        $this->music = $music;
    }

    public function getallMusic()
    {
        $music_data = $this->music->newQuery()
            ->leftjoin('users', 'users.id', '=', 'music.user_id')
            ->leftjoin('likes', 'likes.music_id', '=', 'music.id')
            ->select(
                'music.id',
                'users.id as user_id',
                'music_name',
                'music.image',
                'music.created_at',
                'music.updated_at',
                'users.name',
                DB::raw('count(likes.id) as likes_count')
            )
            ->groupBy('music.id');

        return $music_data;
    }

    public function findByMusicId(int $id): Music
    {
        return $this->music::find($id);
    }

    public function serchMusic(string $keyword)
    {
        return $this->music->where('music_name', 'LIKE', "%{$keyword}%")->orwhere('category', 'LIKE', "%{$keyword}%");
    }

    public function storeMusic($music_data): void
    {
        $this->music->fill([
            'user_id'    => $music_data['user_id'],
            'music_name'  => $music_data['music_name'],
            'music_path'  => $music_data['music_path'],
            'category'    => $music_data['category'],
            'image'       => $music_data['image'],
            'description' => $music_data['description']
        ])->save();
    }
}
