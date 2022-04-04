<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * CreateFightsTable
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
        Schema::create('fights', function (Blueprint $oTable) {
            $oTable->bigIncrements('fight_no')->autoIncrement();
            $oTable->integer('user_id');
            $oTable->string('status', 1)->nullable();
            $oTable->string('game_winner', 1)->nullable();
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
        Schema::dropIfExists('fights');
    }
};
