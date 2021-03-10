<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDreamsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('dreams', function (Blueprint $table) {
			$table->id();

			$table->string('user_name', 100);
			$table->tinyInteger('user_age');
			$table->string('user_country', 100);
			$table->string('user_email', 255)->nullable();
			$table->boolean('user_email_optin')->default(false);
			$table->date('dream_date')->nullable();
			$table->string('dream_language');
			$table->boolean('dream_is_nsfw')->default(false);
			$table->boolean('dream_is_published')->default(false);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('dreams');
	}
}
