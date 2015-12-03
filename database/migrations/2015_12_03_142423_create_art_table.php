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
            $table->char('currency', 3)->nullable()->default('IDR');
            $table->decimal('price',15,2)->nullable()->default(0);
            $table->string('title');
            $table->text('description');
            $table->string('size')->nullable();
            $table->string('image_url');
            $table->string('thumbnail_url');
            $table->boolean('sold')->default(false);
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
