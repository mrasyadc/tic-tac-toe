<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id_1');
            $table->unsignedBigInteger('user_id_2');
            $table->enum('user_1_icon',['X','O']);
            $table->enum('user_2_icon',['X','O']);
            $table->enum('status',['playing','finish']);
            $table->unsignedBigInteger('winner')->nullable();
            $table->enum('box_1',['#','X','O'])->default('#');
            $table->enum('box_2',['#','X','O'])->default('#');
            $table->enum('box_3',['#','X','O'])->default('#');
            $table->enum('box_4',['#','X','O'])->default('#');
            $table->enum('box_5',['#','X','O'])->default('#');
            $table->enum('box_6',['#','X','O'])->default('#');
            $table->enum('box_7',['#','X','O'])->default('#');
            $table->enum('box_8',['#','X','O'])->default('#');
            $table->enum('box_9',['#','X','O'])->default('#');
            $table->enum('turn',[1,2]);
            $table->foreign('user_id_1')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('user_id_2')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('winner')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('match');
    }
}
