<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * CreateUserTable
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
        Schema::create('user', function (Blueprint $oTable) {
            $oTable->bigInteger('user_id')->autoIncrement();
            $oTable->string('username', '150')->unique();
            $oTable->string('password', '255');
            $oTable->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
};
