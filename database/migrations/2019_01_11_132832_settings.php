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
			$table->string('name', 255)->unique();
			$table->string('caption', 255)->unique();
			$table->enum('datatype', ['float','int','text']);
			$table->enum('system', ['y','n']);
			$table->integer('created_user_id')->index();
			$table->integer('updated_user_id')->index();
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
		Schema::dropIfExists('settings');
    }
}
