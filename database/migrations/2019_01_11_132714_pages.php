<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('pages', function (Blueprint $table) {
			$table->increments('id');
            $table->enum('type', ['page','post']);
			$table->string('title', 255)->nullable();
			$table->string('slug', 255);
			$table->text('content')->nullable();
            $table->integer('parent_id')->nullable();
			$table->integer('created_user_id');
			$table->integer('updated_user_id');
			$table->timestamps();
			$table->softDeletes();
            $table->unique('slug');
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
		Schema::dropIfExists('pages');
    }
}
