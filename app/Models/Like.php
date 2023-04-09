<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'likes';

    /**
     * 複数代入可能な属性
     *
     * @var array
     */
    protected $fillable =
    [
        'created_at',
        'updated_at',
        'user_id',
        'music_id',
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

    public function user()
    {   //usersテーブルとのリレーションを定義するuserメソッド
        return $this->belongsTo(User::class);
    }

    public function music()
    {   //musicテーブルとのリレーションを定義するuserメソッド
        return $this->belongsTo(Music::class);
    }
    public function isLikedBy($music): bool
    {
        return Like::where('user_id', $music->user_id)->where('music_id', $music->id)->first() !== null;
    }
}
