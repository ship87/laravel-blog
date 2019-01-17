<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('posts', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title', 255)->nullable();
			$table->string('slug', 255)->unique();
			$table->text('content')->nullable();
			$table->enum('no_comments', ['Y','N']);
			$table->integer('created_user_id')->index();
			$table->integer('updated_user_id')->index();
			$table->timestamps();
			$table->softDeletes();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('posts');
    }
}
