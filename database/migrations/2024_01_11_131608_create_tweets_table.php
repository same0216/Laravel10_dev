<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void {
    Schema::create('tweets', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id')->comment('ユーザー名');
      $table->string('text')->comment('本文');
      $table->softDeletes();  // 論理削除の日付カラムを追加
      $table->timestamps();

      // カラムにインデックスを追加
      $table->index('id');
      $table->index('user_id');
      $table->index('text');

      // 外部キー制約　usersテーブルのidカラムを参照してデータの整合性を保つ
      $table->foreign('user_id')
        ->references('id')
        ->on('users')
        ->onDelete('cascade')
        ->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void {
    Schema::dropIfExists('tweets');
  }
};
