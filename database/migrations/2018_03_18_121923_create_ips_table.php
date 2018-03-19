<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ips', function(Blueprint $table) {
			$table->increments('id');
			$table->string('registry');
			$table->string('cc');
			$table->string('type');
			$table->string('start');
			$table->string('value');
			$table->string('date');
			$table->string('status');
			$table->string('opaque_id')->nullable();
			$table->string('extensions')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('ips');
	}
}
