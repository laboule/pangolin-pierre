<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPublishedAndAccessIdToDreamsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('dreams', function (Blueprint $table) {
			$table->boolean('is_published')->default(false);
			$table->string('access_id')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('dreams', function (Blueprint $table) {
			$table->dropColumn('is_published');
			$table->dropColumn('access_id');
		});
	}
}
