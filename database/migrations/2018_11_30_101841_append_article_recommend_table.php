<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppendArticleRecommendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasColumn('recommend', 'articles')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->integer('recommend')->default(0)->comment('是否推荐 1:是 0:否');
            });
        }
        if (! Schema::hasColumn('recommend', 'status')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->integer('status')->default(1)->comment('状态 1:是 0:否');
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
            $table->dropColumn('recommend');
            $table->dropColumn('status');
        });
    }
}
