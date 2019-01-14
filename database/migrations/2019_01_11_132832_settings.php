<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Settings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('settings', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->string('caption', 255);
			$table->enum('datatype', ['float','int','text']);
			$table->enum('system', ['y','n']);
			$table->integer('created_user_id');
			$table->integer('updated_user_id');
			$table->timestamps();
			$table->unique('name');
			$table->unique('caption');
			$table->index('created_user_id');
			$table->index('updated_user_id');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('settings');
    }
}
