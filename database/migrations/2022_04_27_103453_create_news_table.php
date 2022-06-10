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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('heading_en')->nullable();
            $table->string('heading_tg')->nullable();
            $table->string('heading_am')->nullable();
            $table->string('heading_or')->nullable();
            $table->text('body_en')->nullable();
            $table->text('body_tg')->nullable();
            $table->text('body_am')->nullable();
            $table->text('body_or')->nullable();
            $table->string('picture');
            $table->bigInteger('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('news');
    }
};
