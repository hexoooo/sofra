<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('body');
			$table->integer('notificationable_id');
			$table->string('notificationable_type');
			$table->string('title');
			$table->integer('order_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}