<?php

namespace App\Repositories\Interfaces;

use App\Models\Music;

interface MusicRepositoryInterface
{
    public function getallMusic();

    public function findByMusicId(int $id): Music;

    public function serchMusic(string $keyword);

    public function storeMusic(array $music_data): void;
}
