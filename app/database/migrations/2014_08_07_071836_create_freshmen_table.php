<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreshmenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('freshmen',function($table){
			$table->increments('id');
			$table->enum('type',array('GCAT','AST','JCEE'));
			/*
				GCAT=>學測
				AST=>指考
				JCEE=>統測
			*/
			$table->text('ticket');
			$table->text('facebook');
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
		Schame::drop('freshmen');
	}

}
