<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class Permissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
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

        $dataPermissions = [
            ['1', 'category view', 'category-view', 'Y'],
            ['2', 'category create', 'category-create', 'Y'],
            ['3', 'category update', 'category-update', 'Y'],
            ['4', 'category delete', 'category-delete', 'Y'],
            ['5', 'tag view', 'tag-view', 'Y'],
            ['6', 'tag create', 'tag-create', 'Y'],
            ['7', 'tag update', 'tag-update', 'Y'],
            ['8', 'tag delete', 'tag-delete', 'Y'],
            ['9', 'post view', 'post-view', 'Y'],
            ['10', 'post create', 'post-create', 'Y'],
            ['11', 'post update', 'post-update', 'Y'],
            ['12', 'post delete', 'post-delete', 'Y'],
            ['13', 'page view', 'page-view', 'Y'],
            ['14', 'page create', 'page-create', 'Y'],
            ['15', 'page update', 'page-update', 'Y'],
            ['16', 'page delete', 'page-delete', 'Y'],
            ['17', 'metatag view', 'metatag-view', 'Y'],
            ['18', 'metatag create', 'metatag-create', 'Y'],
            ['19', 'metatag update', 'metatag-update', 'Y'],
            ['20', 'metatag delete', 'metatag-delete', 'Y'],
            ['21', 'page comment view', 'page-comment-view', 'Y'],
            ['22', 'page comment update', 'page-comment-update', 'Y'],
            ['23', 'page comment delete', 'page-comment-delete', 'Y'],
            ['24', 'post comment view', 'post-comment-view', 'Y'],
            ['25', 'post comment update', 'post-comment-update', 'Y'],
            ['26', 'post comment delete', 'post-comment-delete', 'Y'],
            ['27', 'role view', 'role-view', 'Y'],
            ['28', 'role create', 'role-create', 'Y'],
            ['29', 'role update', 'role-update', 'Y'],
            ['30', 'role delete', 'role-delete', 'Y'],
            ['31', 'permission view', 'permission-view', 'Y'],
            ['32', 'permission create', 'permission-create', 'Y'],
            ['33', 'permission update', 'permission-update', 'Y'],
            ['34', 'permission delete', 'permission-delete', 'Y'],
        ];

        foreach ($dataPermissions as $dataPermission) {
            $insert[] = array_combine($columns, $dataPermission);
        }

        DB::table('permissions')->insert($insert);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
