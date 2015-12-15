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
            $table->boolean('1');
            $table->boolean('2');
            $table->boolean('3');
            $table->boolean('4');
            $table->boolean('5');
            $table->boolean('6');
            $table->boolean('7');
            $table->boolean('8');
            $table->boolean('9');
            $table->boolean('daily');
            $table->boolean('progressive');
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
