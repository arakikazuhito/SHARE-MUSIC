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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id')->length(32)->comment('ID');
            $table->string('name')->unique()->comment('ユーザネーム');
            $table->string('email')->unique()->comment('メールアドレス');
            $table->string('password')->unique()->comment('パスワード');
            $table->string('image')->default('no_image500.jpeg')->nullable()->comment('ユーザイメージ');
            $table->string('self_introduction')->nullable()->comment('自己紹介');
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
        Schema::dropIfExists('users');
    }
};
