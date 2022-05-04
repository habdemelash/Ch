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
            $table->string('title');
            $table->string('picture')->default('picture.png');
            $table->string('short_desc');
            $table->text('details');
            $table->string('due_date');
            $table->string('start_time');
            $table->bigInteger('needed_vols')->default(1);
            $table->string('end_time');
            $table->string('location');
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
