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
        Schema::create('books', function (Blueprint $table) {
             $table->bigIncrements('id');
             $table->string('item_name'); //追加
             $table->integer('item_number'); //追加
             $table->integer('item_amount'); //追加
             $table->datetime('published'); //追加
             $table->bigInteger('user_id'); //Add:user_id
             $table->string('image');
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
        Schema::dropIfExists('books');
    }
};
