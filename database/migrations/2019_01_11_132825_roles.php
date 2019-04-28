<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

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
            $table->string('title', 255)->unique();
            $table->string('slug', 255)->unique();
            $table->enum('system', ['Y', 'N'])->default('N');
        });

        $columns = [
            'id',
            'title',
            'slug',
            'system',
        ];

        $dataRoles = [
            [1, 'Super user', 'super-user', 'Y'],
            [2, 'Administrator', 'administrator', 'N'],
            [3, 'Editor', 'editor', 'N'],
            [4, 'User', 'user', 'N'],
        ];

        foreach ($dataRoles as $dataRole) {
            $insert[] = array_combine($columns, $dataRole);
        }

        DB::table('roles')->insert($insert);
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
