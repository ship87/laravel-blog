<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class PermissionRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('role_id')->index();
            $table->integer('permission_id')->index();
            $table->unique(['role_id', 'permission_id']);
        });

        $columns = [
            'role_id',
            'permission_id',
        ];

        $dataPermissionsRoles = [
            [2, 1],
            [2, 2],
            [2, 3],
            [2, 4],
            [2, 5],
            [2, 6],
            [2, 7],
            [2, 8],
            [2, 9],
            [2, 10],
            [2, 11],
            [2, 12],
            [2, 13],
            [2, 14],
            [2, 15],
            [2, 16],
            [2, 17],
            [2, 18],
            [2, 19],
            [2, 20],
            [2, 21],
            [2, 22],
            [2, 23],
            [2, 24],
            [2, 25],
            [2, 26],
            [2, 27],
            [2, 28],
            [2, 29],
            [2, 30],
            [2, 31],
            [2, 32],
            [2, 33],
            [2, 34],
            [3, 1],
            [3, 2],
            [3, 3],
            [3, 4],
            [3, 5],
            [3, 6],
            [3, 7],
            [3, 8],
            [3, 9],
            [3, 10],
            [3, 11],
            [3, 12],
            [3, 13],
            [3, 14],
            [3, 15],
            [3, 16],
            [3, 17],
            [3, 18],
            [3, 19],
            [3, 20],
            [3, 21],
            [3, 22],
            [3, 23],
            [3, 24],
            [3, 25],
            [3, 26],
            [4, 1],
            [4, 5],
            [4, 9],
            [4, 13],
            [4, 17],
            [4, 21],
            [4, 24],
        ];

        foreach ($dataPermissionsRoles as $dataPermissionRole) {
            $insert[] = array_combine($columns, $dataPermissionRole);
        }

        DB::table('permission_role')->insert($insert);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_role');
    }
}
