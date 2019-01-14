<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('post_tag', function (Blueprint $table) {
			$table->integer('post_id');
			$table->integer('tag_id');
			$table->unique(['post_id','tag_id']);
			$table->index('post_id');
			$table->index('tag_id');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('post_tag');
    }
}
