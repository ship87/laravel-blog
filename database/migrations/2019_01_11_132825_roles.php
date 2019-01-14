<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Roles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('roles', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->string('caption', 255);
			$table->unique('name');
			$table->unique('caption');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('roles');
    }
}
