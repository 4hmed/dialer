<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactphoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_phone', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone');
            $table->string('code');
            $table->integer('contact_id')->unsigned();

            $table->foreign('contact_id')->references('id')->on('contacts')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('contact_phone');
    }
}
