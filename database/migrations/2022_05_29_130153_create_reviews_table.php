<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('body', 300);
            $table->unsignedSmallInteger('get_credit');
            $table->unsignedSmallInteger('adequacy');
            $table->timestamps();
            $table->integer('faculty_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();    //unsigned()型で定義
            //'user_id' は 'usersテーブル' の 'id' を参照する外部キーです
            $table->integer('evaluation_id')->unsigned();
            $table->bigInteger('subject_id')->unsigned();
            $table->bigInteger('teacher_id')->unsigned();    //unsigned()型で定義
            //'teacher_id' は 'teacherssテーブル' の 'id' を参照する外部キーです
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
