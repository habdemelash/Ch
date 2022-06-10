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
        Schema::create('helpmes', function (Blueprint $table) {
            $table->id();
            $table->string('name_am')->nullable(); 
            $table->string('name_tg')->nullable(); 
            $table->string('name_or')->nullable(); 
            $table->string('name_en')->nullable(); 
            $table->string('phone');
            $table->string('email');
            $table->string('address_am')->nullable();
            $table->string('address_tg')->nullable();
            $table->string('address_or')->nullable();
            $table->string('address_en')->nullable();
            $table->string('problem_title_am')->nullable();
            $table->string('problem_title_tg')->nullable();
            $table->string('problem_title_or')->nullable();
            $table->string('problem_title_en')->nullable();
            $table->text('problem_details_am')->nullable();
            $table->text('problem_details_tg')->nullable();
            $table->text('problem_details_or')->nullable();
            $table->text('problem_details_en')->nullable();
            $table->boolean('seen')->default(0);
             $table->enum('status',['Pending','Rejected','Accepted'])->default('Pending');
            $table->bigInteger('sender')->unsigned()->nullable();
            $table->bigInteger('accepted_by')->unsigned()->nullable();
            $table->foreign('sender')->references('id')->on('users')->onDelete('cascade');
            
            $table->foreign('accepted_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('helpmes');
    }
};
