<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthRoleItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_role_items', function (Blueprint $table) {
            $table->string('item_type');
            $table->integer('item_id');
            $table->integer('role_id');

            $table->timestamps();

            $table->primary([
                'item_type',
                'item_id',
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
        Schema::dropIfExists('auth_role_items');
    }

}
