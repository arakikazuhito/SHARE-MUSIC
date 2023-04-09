<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Music extends Model
{
    use HasFactory;
    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'music';

    /**
     * 複数代入可能な属性
     *
     * @var array
     */
    protected $fillable =
    [
        'user_id',
        'music_name',
        'music_path',
        'category',
        'image',
        'description',
        'created_at',
        'updated_at',
    ];

    /**
     * 複数代入しない属性
     * 
     * 
     * @var array
     */
    protected $guarded =
    [
        'id'
    ];



    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function comments_replay()
    {
        return $this->hasMany(Comment_replay::class);
    }
    public function isLikedBy($music)
    {
        $user_id = Auth::user()->id;
        return Like::where('user_id', $user_id)->where('music_id', $music->id)->exists();
    }
}
