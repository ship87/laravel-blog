<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Comments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('comments', function (Blueprint $table) {
			$table->increments('id');
			$table->text('content');
			$table->enum('type', ['page','post']);
			$table->integer('page_id')->index()->nullable();
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
		Schema::dropIfExists('comments');
    }
}
