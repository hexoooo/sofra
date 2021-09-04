<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->integer('region_id')->unsigned();
			$table->string('password');
			$table->decimal('delivery_charge');
			$table->decimal('minimum_charge');
			$table->string('api_token')->default(null);
			$table->string('reset_password_code')->default(null);
			$table->string('active')->default(0);
			$table->string('photo')->default(null);
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}