<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('music', function (Blueprint $table) {
            $table->id('id')->length(32)->unique()->comment('ID');
            $table->integer('user_id')->length(32)->comment('ユーザID');
            $table->string('music_name')->comment('曲名');
            $table->string('music_path')->unique()->comment('曲のバス');
            $table->string('category')->comment('カテゴリー');
            $table->string('image')->default('/img/no_image500.jpeg')->comment('ジャケット画像');
            $table->string('description')->nullable()->comment('説明');
            $table->dateTime('created_at')->nullable()->comment('登録日時');
            $table->dateTime('updated_at')->nullable()->comment('更新日時');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('music');
    }
};
