<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            //increments: 递增 ID（主键），相当于 UNSIGNED INTEGER
            $table->increments('id');
            //text: 相当于TEXT
            $table->text('content');
            //integer: 相当于INTEGER。index：创建一个索引
            $table->integer('user_id')->index();
            //创建复合索引
            $table->index(['created_at']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
