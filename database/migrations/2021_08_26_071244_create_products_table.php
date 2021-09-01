<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->decimal('price');
			$table->integer('preparation_times');
			$table->text('description');
			$table->integer('restaurant_id')->unsigned();
			$table->decimal('offer_price')->default(null);
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}