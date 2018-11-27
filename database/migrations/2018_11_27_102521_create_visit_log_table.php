<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100)->default('游客')->comment('访客名称');
            $table->string('ip',100)->default('127.0.0.1')->comment('ip');
            $table->string('longitude',100)->nullable()->comment('经度');
            $table->string('latitude',100)->nullable()->comment('纬度');
            $table->string('address',100)->nullable()->comment('城市地址');
            $table->string('url',150)->nullable()->comment('访问地址');
            $table->timestamps();
            $table->index('ip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visit_log');
    }
}
