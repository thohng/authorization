<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthRoleObjectsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_role_objects', function (Blueprint $table) {
            $table->integer('role_id');
            $table->string('subject_type');
            $table->integer('subject_id');
            $table->string('object_type');
            $table->integer('object_id');

            $table->timestamps();
            $table->primary([
                'role_id',
                'subject_type',
                'subject_id',
                'object_type',
                'object_id'
            ], 'role_item');
            $table->index([
                'subject_type',
                'subject_id',
                'object_type',
                'object_id'
            ], 'subject_object');
            $table->index([
                'role_id',
                'subject_type',
                'subject_id'
            ], 'role_subject');
            $table->index([
                'role_id',
                'object_type',
                'object_id'
            ], 'role_object');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth_role_objects');
    }

}
