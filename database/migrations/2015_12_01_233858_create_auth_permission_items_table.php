<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthPermissionItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_permission_items', function (Blueprint $table) {
            $table->integer('permission_id');
            $table->string('subject_type');
            $table->integer('subject_id');
            $table->string('object_type');
            $table->integer('object_id');

            $table->timestamps();
            $table->primary([
                'permission_id',
                'subject_type',
                'subject_id',
                'object_type',
                'object_id'
            ], 'permission_item');
            $table->index([
                'subject_type',
                'subject_id',
                'object_type',
                'object_id'
            ], 'subject_object');
            $table->index([
                'permission_id',
                'subject_type',
                'subject_id'
            ], 'permission_subject');
            $table->index([
                'permission_id',
                'object_type',
                'object_id'
            ], 'permission_object');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth_permission_items');
    }

}
