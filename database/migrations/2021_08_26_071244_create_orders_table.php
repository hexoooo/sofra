<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('client_name');
			$table->decimal('total_price')->default('0');;
			$table->string('address');
			$table->string('phone');
			$table->string('status')->nullable()->default('null');
			$table->integer('restaurant_id')->unsigned();
			$table->integer('client_id')->unsigned();
			$table->decimal('order_price')->default('0');
			$table->decimal('delivery_charge');
			$table->decimal('commission')->default('1');;
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}