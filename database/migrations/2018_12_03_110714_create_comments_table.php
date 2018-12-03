<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->comment('评论者ID');
            $table->integer('target_user')->unsigned()->comment('作者ID');
            $table->integer('reply_user')->unsigned()->default(0)->comment('被评论者ID');
            $table->integer('parent_id')->default(0)->comment('上级评论ID');
            $table->string('commentable_type',100);
            $table->bigInteger('commentable_id')->unsigned();
            $table->text('content')->comment('评论内容');
            $table->timestamps();
            $table->index(['user_id','target_user','reply_user','parent_id']);
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
}
