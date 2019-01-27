<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('post_comments', function (Blueprint $table) {
			$table->increments('id');
			$table->text('content');
			$table->integer('post_id')->index()->nullable();
			$table->integer('parent_id')->nullable();
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
		Schema::dropIfExists('post_comments');
    }
}
