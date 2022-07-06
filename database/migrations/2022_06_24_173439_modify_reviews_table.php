<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->integer('faculty_id')->unsigned()->nullable(false)->change();
            $table->bigInteger('user_id')->unsigned()->nullable(false)->change();
            $table->integer('evaluation_id')->unsigned()->nullable(false)->change();
            $table->bigInteger('subject_id')->unsigned()->nullable(false)->change();
            $table->bigInteger('teacher_id')->unsigned()->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->integer('faculty_id')->unsigned()->nullable()->change();
            $table->bigInteger('user_id')->unsigned()->nullable()->change();
            $table->integer('evaluation_id')->unsigned()->nullable()->change();
            $table->bigInteger('subject_id')->unsigned()->nullable()->change();
            $table->bigInteger('teacher_id')->unsigned()->nullable()->change();
        });
    }
}
