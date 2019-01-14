<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoryPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('category_post', function (Blueprint $table) {
            $table->integer('category_id');
			$table->integer('post_id');
			$table->unique(['category_id','post_id']);
            $table->index('category_id');
			$table->index('post_id');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('category_post');
    }
}
