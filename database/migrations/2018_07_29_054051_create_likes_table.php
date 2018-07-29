<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
 /**
  * Run the migrations.
  *
  * @return void
  */
 public function up()
 {
  Schema::create('likes', function (Blueprint $table) {
   $table->increments('id');
   $table->integer('user_id')->unsigned();
   $table->integer('post_id')->unsigned()->nullable();
   $table->integer('comment_id')->unsigned()->nullable();
   $table->timestamps();
   $table->unique(['user_id', 'post_id']);
   $table->unique(['user_id', 'comment_id']);
  });
 }

 /**
  * Reverse the migrations.
  *
  * @return void
  */
 public function down()
 {
  Schema::dropIfExists('likes');
 }
}
