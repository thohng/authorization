<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthRoleItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('auth_role_items', function(Blueprint $table)
		{
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
