<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccessIdToDreamsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		if (!Schema::hasColumn('dreams', 'access_id')) {
			Schema::table('dreams', function (Blueprint $table) {
				$table->string('access_id')->nullable();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('dreams', function (Blueprint $table) {
			$table->dropColumn('access_id');
		});
	}
}
