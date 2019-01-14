<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MetaTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('metatags', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('page_id');
			$table->enum('name', ['title','description','keywords','robots']);
			$table->string('content', 255);
			$table->unique(['page_id','name']);

		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('metatags');
    }
}
