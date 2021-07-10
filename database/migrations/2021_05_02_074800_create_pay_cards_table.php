<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //table
        Schema::create('pay_cards', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->bigInteger('phoneNum');
            $table->string('name');
            $table->bigInteger('cardNum');
            $table->Integer('cvv');
            $table->Integer('amount');
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
        Schema::dropIfExists('pay_cards');
    }
}
