<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('art', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artworker_id');
            $table->char('currency', 3);
            $table->decimal('price',15,2);
            $table->string('title');
            $table->text('description');
            $table->string('size');
            $table->string('image_url');
            $table->string('thumbnail_url');
            $table->boolean('sold');
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
        Schema::drop('art');
    }
}
