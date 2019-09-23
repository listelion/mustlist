<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->increments('user_id');
            $table->string('name');
            $table->text('content');
            $table->increments('level');
            $table->increments('category_id');
            $table->date('sdate');
            $table->date('edate');
            $table->time('stime');
            $table->time('etime');
            $table->boolean('repeat')->default(false);
            $table->boolean('completed')->default(false);
            $table->timestamps();
            $table->datetime('deleted_at');
            $table->boolean('delete_yn')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
