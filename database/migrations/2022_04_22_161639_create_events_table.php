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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title_am')->nullable();
            $table->string('title_tg')->nullable();
            $table->string('title_or')->nullable();
            $table->string('title_en')->nullable();
            $table->string('picture')->default('picture.png');
            $table->string('short_desc_am')->nullable();
            $table->string('short_desc_tg')->nullable();
            $table->string('short_desc_or')->nullable();
            $table->string('short_desc_en')->nullable();
            $table->text('details_am')->nullable();
            $table->text('details_tg')->nullable();
            $table->text('details_or')->nullable();
            $table->text('details_en')->nullable();
            $table->string('due_date');
            $table->string('start_time');
            $table->bigInteger('needed_vols')->default(1);
            $table->string('end_time');
            $table->string('location_am')->nullable();
            $table->string('location_tg')->nullable();
            $table->string('location_or')->nullable();
            $table->string('location_en')->nullable();
            $table->enum('status',['Upcoming','Past','Cancelled'])->default('Upcoming');
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
        Schema::dropIfExists('events');
    }
};
