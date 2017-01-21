<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_group', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contact_id')->unsigned();
            $table->foreign('contact_id')->references('id')->on('contacts')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->unique(array('contact_id', 'group_id'));
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contact_group');
    }
}
