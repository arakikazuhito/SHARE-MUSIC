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
        Schema::create('comments', function (Blueprint $table) {
            $table->id('id')->length(32)->unique()->comment('ID');
            $table->foreignId('user_id')->constrained()->length(32)->comment('USER_ID');
            $table->foreignId('music_id')->constrained()->length(32)->comment('MUSIC_ID');
            $table->string('comment')->comment('コメント');
            $table->dateTime('created_at')->nullable()->comment('登録日時');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
