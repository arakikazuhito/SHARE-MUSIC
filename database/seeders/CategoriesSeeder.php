<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('categories');

        $data = [
            ['id' => 1, 'name' => 'J-POP'],
            ['id' => 2, 'name' => 'ロック'],
            ['id' => 3, 'name' => 'K-POP'],
            ['id' => 4, 'name' => 'アニメ/ゲーム'],
            ['id' => 5, 'name' => 'ボーカロイド'],
            ['id' => 6, 'name' => 'ポップス'],
            ['id' => 7, 'name' => 'ジャズ'],
            ['id' => 8, 'name' => 'クラシック'],
            ['id' => 9, 'name' => 'ラテン'],
            ['id' => 10, 'name' => 'R&B'],
            ['id' => 11, 'name' => 'ヒップホップ/ラップ'],
            ['id' => 12, 'name' => 'ブルース'],
            ['id' => 13, 'name' => 'レゲエ'],
            ['id' => 14, 'name' => '演歌'],
            ['id' => 15, 'name' => '歌謡曲'],
            ['id' => 16, 'name' => 'ディスコ'],
            ['id' => 17, 'name' => 'オルタナティブ'],
            ['id' => 18, 'name' => 'カラオケ'],
            ['id' => 19, 'name' => 'コメディー'],
            ['id' => 20, 'name' => 'サイケデリック'],
            ['id' => 21, 'name' => 'ハウス'],
            ['id' => 22, 'name' => 'ヘビーメタル'],
            ['id' => 23, 'name' => 'シンガーソング(男性)'],
            ['id' => 24, 'name' => 'シンガーソング(女性)'],
            ['id' => 25, 'name' => 'インストゥメンタル'],
            ['id' => 26, 'name' => 'サウンドエフェクト'],
        ];
        $table->insert($data);
    }
}
