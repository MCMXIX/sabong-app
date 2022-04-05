<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * CreateBetsTable
 * @author Gabriel Villamia <gabriel25han@gmail.com>
 * @since 2022.04.02
 * @version 1.0
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bets', function (Blueprint $oTable) {
            $oTable->bigIncrements('bet_no')->autoIncrement();
            $oTable->integer('fight_no');
            $oTable->integer('user_id');
            $oTable->integer('amount');
            $oTable->string('side', 1);
            $oTable->string('status', 1);
            $oTable->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bets');
    }
};
