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
            $table->string('item_type');
            $table->integer('item_id');
            $table->integer('permission_id');

            $table->timestamps();

            $table->primary([
                'item_type',
                'item_id',
                'permission_id'
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
        Schema::dropIfExists('auth_permission_items');
    }

}
