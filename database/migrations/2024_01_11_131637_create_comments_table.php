<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('comments', function (Blueprint $table) {
      $table->increments('id');
      $table->unsignedBigInteger('user_id')->comment('ユーザID');
      $table->unsignedBigInteger('tweet_id')->comment('ツイートID');
      $table->string('text')->comment('本文');
      $table->softDeletes();
      $table->timestamps();

      $table->index('id');
      $table->index('user_id');
      $table->index('tweet_id');

      $table->foreign('user_id')
        ->references('id')
        ->on('users')
        ->onDelete('cascade')
        ->onUpdate('cascade');

      $table->foreign('tweet_id')
        ->references('id')
        ->on('tweets')
        ->onDelete('cascade')
        ->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('comments');
  }
};
