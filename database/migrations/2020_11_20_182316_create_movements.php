<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movements', function (Blueprint $table) {
			$table->uuid('id')->primary()->unique();
			$table->uuid('user_category_id');
			$table->uuid('user_id');
			$table->string('quantity');
			$table->boolean('isIncome');
			$table->timestamps();


			$table->foreign('user_category_id')->references('id')->on('users_categories');
			$table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movements');
    }
}
