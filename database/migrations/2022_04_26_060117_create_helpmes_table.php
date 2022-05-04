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
            $table->string('name'); 
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('problem_title');
            $table->text('problem_details');
            $table->boolean('seen')->default(0);
             $table->enum('status',['Pending','Rejected','Accepted'])->default('Pending');
            $table->bigInteger('sender')->unsigned()->nullable();
            $table->bigInteger('accepted_by')->unsigned()->nullable();
            $table->foreign('sender')->references('id')->on('users')->onDelete('cascade');
            
            $table->foreign('accepted_by')->references('id')->on('users')->onDelete('set null');
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
