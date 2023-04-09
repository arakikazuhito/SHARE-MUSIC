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
        Schema::create('likes', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->dateTime('created_at')->nullable()->comment('登録日時');
            $table->dateTime('updated_at')->nullable()->comment('更新日時');
            $table->foreignId('user_id')->constrained()->comment('ユーザID');
            $table->foreignId('music_id')->constrained()->comment('音楽ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
};
