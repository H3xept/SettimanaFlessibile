<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseInstallersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_installers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('description');
            $table->integer('maxStudentsPerStripe');
            //Stripes attributes
            $table->integer('one');
            $table->integer('two');
            $table->integer('three');
            $table->integer('four');
            $table->integer('five');
            $table->integer('six');
            $table->integer('seven');
            $table->integer('eight');
            $table->integer('nine');
            $table->boolean('single_stripe');
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
        Schema::drop('course_installers');
    }
}
