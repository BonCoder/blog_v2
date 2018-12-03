<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppendCommentCountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasColumn('articles', 'comment_count')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->integer('comment_count')->default(0)->comment('评论数量');
            });
        }
        if (! Schema::hasColumn('articles', 'user_id')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->integer('user_id')->default(1)->comment('作者ID');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('comment_count');
            $table->dropColumn('user_id');
        });
    }
}
