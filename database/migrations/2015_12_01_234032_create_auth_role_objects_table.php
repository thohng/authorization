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
            $table->string('object_type');
            $table->integer('object_id');
            $table->integer('role_id');

            $table->timestamps();

            $table->primary([
                'object_type',
                'object_id',
                'role_id'
            ]);
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
