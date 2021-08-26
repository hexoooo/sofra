<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactUsTable extends Migration {

	public function up()
	{
		Schema::create('contact_us', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email');
			$table->string('address');
			$table->text('message');
			$table->enum('type', array('Enquiry', 'complaint', 'other'));
		});
	}

	public function down()
	{
		Schema::drop('contact_us');
	}
}