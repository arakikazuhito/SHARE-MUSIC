<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * モデルに関連付けるテーブル
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * 複数代入可能な属性
     *
     * @var array
     */
    protected $fillable =
    [
        'user_id',
        'music_id',
        'comment',
        'created_at'
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

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function music()
    {
        return $this->belongsTo(Music::class);
    }
    public function comments_replay()
    {
        return $this->hasMany(Comment_replay::class);
    }
}
